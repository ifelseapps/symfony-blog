<?php

namespace App\Core\Application\Gateways;

use App\Core\Infrastructure\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $entity, bool $flush = false): void;

    public function findUserByToken(string $token): ?User;
}