<?php

namespace App\Authorizations;

use Symfony\Component\Security\Core\Security;
use App\Authorizations\AuthentificationCheckerInterface;
use App\Exceptions\AuthentificationException;
use Symfony\Component\HttpFoundation\Response;

class AuthentificationChecker implements AuthentificationCheckerInterface
{
    protected $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }
    
    public function isAuthenticated(): void
    {
        if (null === $this->user) {
            throw new AuthentificationException(Response::HTTP_UNAUTHORIZED, self::ERROR_MESSAGE);
        }
    }
}