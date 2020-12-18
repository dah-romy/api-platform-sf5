<?php

namespace App\Services;

use App\Entity\User;

interface ResourceUpdatorInterface
{
    public function process(string $method, User $user):bool;
}