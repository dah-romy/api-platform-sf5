<?php

namespace App\Authorizations;

interface ResourceAccessCheckerInterface
{
    const ERROR_MESSAGE = "It's not your resource";
    public function canAccess(?int $id): void;
}