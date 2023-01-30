<?php

namespace App\Blog\Application\Interactors;

class GetPostInputDto
{
    public ?int $page = null;

    public ?int $perPage = null;
}