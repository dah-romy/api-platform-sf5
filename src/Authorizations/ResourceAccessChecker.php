<?php

namespace App\Authorizations;

use App\Exceptions\ResourceAccessException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use App\Authorizations\ResourceAccessCheckerInterface;

class ResourceAccessChecker implements ResourceAccessCheckerInterface
{
    protected $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function canAccess(?int $id): void
    {
        if ($this->user->getId() !== $id) {
            throw new ResourceAccessException(Response::HTTP_UNAUTHORIZED, self::ERROR_MESSAGE);
            
        }
    }
}