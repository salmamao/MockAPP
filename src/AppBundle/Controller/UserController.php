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
        return $this->render('profile/profile.html.twig');
    }
}