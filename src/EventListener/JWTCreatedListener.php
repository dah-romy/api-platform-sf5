<?php

namespace App\EventListener;

use Symfony\Component\Security\Core\Security;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{
    protected $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function onJWTCreated(JWTCreatedEvent $event){
        $payload = $event->getData();
        $payload["createdAt"] = $this->user->createdAt();
        $event->setData($payload);
    }
}