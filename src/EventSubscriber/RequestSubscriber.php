<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class RequestSubscriber implements EventSubscriberInterface
{
    use TargetPathTrait;

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function onSecurityAuthenticationSuccess(RequestEvent $event)
    {
        $request = $event->getRequest();
        if (
            !$event->isMasterRequest()
            || $request->isXmlHttpRequest()
            || 'login' === $request->attributes->get('_route')
            || 'vote' === $request->attributes->get('_route')
            || 'flag' === $request->attributes->get('_route')
            || 'signup' === $request->attributes->get('_route')
            || 'connect_facebook' === $request->attributes->get('_route')
          
        ) 
        {
            return;
        }

        $this->saveTargetPath($this->session, 'main', $request->getUri());
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => ['onSecurityAuthenticationSuccess']
        ];
    }
}
