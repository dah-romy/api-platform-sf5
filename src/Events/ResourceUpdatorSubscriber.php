<?php

namespace App\Events;

use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Product;
use App\Services\ResourceUpdatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ResourceUpdatorSubscriber implements EventSubscriberInterface
{
    private $methodNotAllowed = [
        Request::METHOD_POST,
        Request::METHOD_GET
    ];

    protected $resourceUpdator;

    public function __construct(ResourceUpdatorInterface $resourceUpdator)
    {
        $this->resourceUpdator = $resourceUpdator;
    }

    public static function getSubscribedEvents(){
        return [
            KernelEvents::VIEW => ['check', EventPriorities::PRE_VALIDATE]
        ];
    }

    public function check(ViewEvent $event):void
    {
        $object = $event->getControllerResult();
        
        if ($object instanceof User || $object instanceof Product) {
            $user = $object instanceof User ? $object: $object->getAuthor();

            $canProcess = $this->resourceUpdator->process($event->getRequest()->getMethod(),$user);
            if ($canProcess) {
                $object->updatedAt(new \DateTime("now"));
            }
        }
    }
}