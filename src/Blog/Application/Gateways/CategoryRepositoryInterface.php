<?php

namespace App\Blog\Application\Gateways;

use App\Blog\Domain\Category;

interface CategoryRepositoryInterface
{
    public function findById(string $id): ?Category;
}