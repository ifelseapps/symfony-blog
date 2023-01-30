<?php

namespace App\Blog\Application\Interactors;

use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;

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

    public static function createFromRequest(Request $request): CreatePostInputDto
    {
        $body = json_decode($request->getContent(), true);

        $dto = new CreatePostInputDto();
        $dto->slug = $body['slug'];
        $dto->title = $body['title'];
        $dto->content = $body['content'];
        $dto->created_at = new DateTimeImmutable($body['created_at']);
        $dto->description = $body['description'];
        $dto->keywords = $body['keywords'];
        $dto->category = $body['category'];
        $dto->enabled = $body['enabled'];

        return $dto;
    }
}