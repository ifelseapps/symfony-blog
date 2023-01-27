<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Infrastructure\Entities\Post;

interface PostRepositoryInterface
{
    public function save(Post $entity, bool $flush): void;
}