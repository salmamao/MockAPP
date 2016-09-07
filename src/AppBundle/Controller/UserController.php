<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
     * @Route("/editUser", name="editUser")
     */
    public function editUserAction()
    {
        return $this->render('profile/editUser.html.twig');
    }
}