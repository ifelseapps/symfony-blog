<?php

namespace App\Blog\Application\Interactors;

use Symfony\Component\HttpFoundation\Request;

class CreateTagInputDto
{
    public string $title;

    public static function createFromRequest(Request $request): CreateTagInputDto
    {
        $body = json_decode($request->getContent(), true);

        $dto = new CreateTagInputDto();
        $dto->title = $body['title'];

        return $dto;
    }
}