<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ProfileType;

class UserController extends Controller
{
    /**
     * @Route("/profile", name="profile")
     */
    public function profileAction()
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find(7);

        return $this->render('profile/profile.html.twig',array('user' => $user));
    }
    /**
     * @Route("/editUser/{id}", name="editUser")
     */
    public function EditUserAction($id,Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id);
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()
                ->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('profile');
        }

        return $this->render(
            'profile/editUser.html.twig', [
                'form' => $form->createView(),
            ]
        );

    }
}