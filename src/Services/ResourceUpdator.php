<?php

namespace App\Services;

use App\Entity\User;
use App\Services\ResourceUpdatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Authorizations\AuthentificationCheckerInterface;
use App\Authorizations\ResourceAccessCheckerInterface;

class ResourceUpdator implements ResourceUpdatorInterface
{
    protected $methodAllowed = [
        Request::METHOD_PUT,
        Request::METHOD_PATCH,
        Request::METHOD_DELETE
    ];

    protected  $resourceAccessChecker;
    protected  $authentificationChecker;

    public function __construct(
        ResourceAccessCheckerInterface $resourceAccessChecker,
        AuthentificationCheckerInterface $authentificationChecker
    )
    {
        $this->resourceAccessChecker =  $resourceAccessChecker;
        $this->authentificationChecker =  $authentificationChecker;
    }

    public function process(string $method, User $user): bool
    {
        if (in_array($method, $this->methodAllowed, true)) {
            $this->authentificationChecker->isAuthenticated();
            $this->resourceAccessChecker->canAccess($user->getId());

            return true;
        }
        return false;
    }
}