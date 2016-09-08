<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Service;

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

            $article->setPublishedAt(new \DateTime());


            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw $this->createAccessDeniedException();
            }
            $userAuth = $this->getUser();
            $userAuthId = (int)$userAuth->getId();

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

        return $this->render('/ArticleViews/showArticle.html.twig');


    }


}