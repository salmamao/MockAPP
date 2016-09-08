<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class articleController extends Controller
{


    /**
     * @Route("/createArticle", name="articleCreation")
     */
    public function createArticleAction(Request $request)
    {

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw $this->createAccessDeniedException();
            }
            $userAuth = $this->getUser();
            $userAuthId = $userAuth->getId();
            $this->container->get("app.article_service")->createArticle($article, $userAuthId);
            $userLogin = $userAuth->getLogin();
            $this->addFlash('success', 'Congrats  '.$userLogin.'   ! your article was created successfully.');

            return $this->redirectToRoute('articleCreation');
        }

        return $this->render(
            'ArticleViews/createArticle.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/showArticle", name="Dashboard")
     */
    public function showArticleAction()
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $userAuth = $this->getUser();
        $userLogin = $userAuth->getLogin();
        $userId = $userAuth->getId();
        $articles = $this->container->get("app.listarticle_service")->displayArticles($userId);

        return $this->render(
            '/ArticleViews/showArticle.html.twig',
            [
                'userLogin' => $userLogin,
                'articles' => $articles,
            ]
        );


    }


}