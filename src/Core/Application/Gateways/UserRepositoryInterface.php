<?php

namespace App\Core\Application\Gateways;

use App\Core\Domain\User;

interface UserRepositoryInterface
{
    public function save(User $entity, bool $flush = false): void;

    public function findUserByToken(string $token): ?User;
}