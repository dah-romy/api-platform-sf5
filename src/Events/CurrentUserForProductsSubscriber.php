<?php

namespace App\Events;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CurrentUserForProductsSubscriber implements EventSubscriberInterface
{

    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW => ['currentUserForProducts', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function currentUserForProducts(ViewEvent $event):void
    {
        $article = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($article instanceof Product && Request::METHOD_POST === $method) {
            $article->setAuthor($this->security->getUser());
        }
    }
}