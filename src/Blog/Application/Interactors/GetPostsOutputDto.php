<?php

namespace App\Blog\Application\Interactors;

class GetPostsOutputDto
{
    public bool $success;

    /** @var PostItemDto[] */
    public array $posts;

    public string $error;
}