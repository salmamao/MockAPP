<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Article;
use AppBundle\Entity\User;
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

            $em = $this->getDoctrine()
                ->getManager();

            if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
                throw $this->createAccessDeniedException();
            }
            $userAuth = $this->getUser();
            $userAuthId = $userAuth->getId();
            $user = $em->getRepository('AppBundle\Entity\User')
                ->find($userAuthId);
            $userId = $user->getId();
            $userLogin = $user->getLogin();
            $article->setUserId($userId);

            $em->persist($article);
            $em->flush();

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