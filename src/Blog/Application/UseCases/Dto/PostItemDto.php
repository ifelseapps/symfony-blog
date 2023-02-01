<?php

namespace App\Blog\Application\UseCases\Dto;

class PostItemDto
{
    public string $id;

    public string $slug;

    public string $title;

    public array $content;

    public int $created_at;

    public string $description;

    public string $keywords;

    public bool $enabled;

    /** @var TagItemDto[] */
    public array $tags;

    public CategoryDto $category;
}