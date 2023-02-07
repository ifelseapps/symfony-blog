<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Domain\Post;

interface PostRepositoryInterface
{
    public function save(Post $entity, bool $flush): void;

    public function remove(Post $entity, bool $flush = false): void;

    public function getAll(?int $page = null, ?int $perPage = null): array;

    public function findById(string $id): ?Post;
}