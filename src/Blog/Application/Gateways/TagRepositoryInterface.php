<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Infrastructure\Entities\Tag;

interface TagRepositoryInterface
{
    public function save(Tag $entity, bool $flush = false): void;
}