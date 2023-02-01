<?php

namespace App\Blog\Application\UseCases\Dto;

class GetPostsInputDto
{
    public ?int $page = null;

    public ?int $perPage = null;
}