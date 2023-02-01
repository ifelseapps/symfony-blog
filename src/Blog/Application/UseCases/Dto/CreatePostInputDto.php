<?php

namespace App\Blog\Application\UseCases\Dto;

use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;

class CreatePostInputDto
{
    public string $slug;

    public string $title;

    public array $content;

    public DateTimeImmutable $created_at;

    public string $description;

    public string $keywords;

    public string $category;

    public bool $enabled;
}