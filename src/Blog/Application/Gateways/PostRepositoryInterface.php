<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Application\Interactors\GetPostInputDto;
use App\Blog\Infrastructure\Entities\Post;

interface PostRepositoryInterface
{
    public function save(Post $entity, bool $flush): void;

    public function getAll(GetPostInputDto $input): array;
}