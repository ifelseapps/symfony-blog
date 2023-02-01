<?php

namespace App\Blog\Application\UseCases\Dto;

class GetPostsOutputDto
{
    public bool $success;

    /** @var PostItemDto[] */
    public array $posts;

    public ErrorDto $error;
}