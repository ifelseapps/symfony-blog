<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Domain\Tag;

interface TagRepositoryInterface
{
    public function save(Tag $entity, bool $flush = false): void;

    public function findById(string $id): ?Tag;

    public function findAll(): array;
}