<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Infrastructure\Entities\Category;

interface CategoryRepositoryInterface
{
    public function findById(string $id): ?Category;
}