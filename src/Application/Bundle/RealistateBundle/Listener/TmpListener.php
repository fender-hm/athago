<?php

namespace Application\Bundle\RealistateBundle\Listener;

use Application\Bundle\UserBundle\Entity\User;
use Symfony\Component\Security\Core\SecurityContext;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\HttpFoundation\Cookie;

/**
 * Tmp listener
 */
class TmpListener
{
    /**
     * @var SecurityContext
     */
    private $context;


    /**
     * Constructor
     *
     * @param SecurityContext $context
     */
    public function __construct(SecurityContext $context)
    {
        $this->context = $context;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }

        $request = $event->getRequest();


        if ($request->isXmlHttpRequest()) {
            return;
        }

        $token = $this->context->getToken();

        if (!$token) {
            return;
        }

        $user = $token->getUser();

        if (!is_object($user) || !$user instanceof User) {
            return;
        }

        $session = $request->getSession();
        $cookie = $request->cookies;
        if (!$session->has('targetTmp')) {
            if ($cookie->has('targetTmp')) {
                $session->set('targetTmp', $cookie->get('targetTmp'));
            } else {
                $targetTmp = uniqid('tTmp');
                $session->set('targetTmp', $targetTmp);
            }
            $session->set('targetTmpToCookie', true);
        } else if (!$cookie->has('targetTmp')) {
            $session->set('targetTmpToCookie', true);
        }

    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }

        $session = $event->getRequest()->getSession();

        if ($session->get('targetTmpToCookie')) {
            $response = $event->getResponse();
            $cookieLocation = new Cookie('targetTmp', $session->get('targetTmp'), 0, '/', ini_get('session.cookie_domain'));
            $response->headers->setCookie($cookieLocation);
            $session->remove('targetTmpToCookie');
        }
    }
}