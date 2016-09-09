<?php

namespace AppBundle\Listener;

use AppBundle\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RedirectUserListener
{

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var RouterInterface
     */
    private $router;


    public function __construct(TokenStorageInterface $tokenStorage, RouterInterface $router)
    {

        $this->tokenStorage = $tokenStorage;
        $this->router       = $router;
    }


    public function onKernelRequest(GetResponseEvent $event)
    {
        if ($this->isUserLogged() && $event->isMasterRequest()) {
            $currentRoute = $event->getRequest()->attributes->get('_route');
            if ($this->isAuthenticatedUserOnAnonymousPage($currentRoute)) {
                $response = new RedirectResponse($this->router->generate('homepage'));
                $event->setResponse($response);
            }
        }
    }


    private function isUserLogged()
    {
        $token = $this->tokenStorage->getToken();

        $user = null;
        if ($token) {
            $user = $token->getUser();
        }

        return $user instanceof User;
    }


    private function isAuthenticatedUserOnAnonymousPage($currentRoute)
    {
        return in_array($currentRoute,
            ['login', 'fos_user_security_login', 'fos_user_resetting_request', 'app_user_registration']);
    }
}