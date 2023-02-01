<?php

namespace App\Blog\Application\Interactors;

class GetPostsInputDto
{
    public ?int $page = null;

    public ?int $perPage = null;
}