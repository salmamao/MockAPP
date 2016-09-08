<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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

        if($user->getAvatar())
        {
            $user->setAvatar(null);
        }

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $user->getAvatar();

            $fileName = $this->get('app.avatar_uploader')->upload($file);

            // Update the 'avatars' property to store the file name
            // instead of its contents
            $user->setAvatar($fileName);

            // ... persist the $product variable or any other work

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