<?php

namespace App\Blog\Application\UseCases\Dto;

class CreatePostOutputDto
{
    public bool $success;

    public string $id;

    public ErrorDto $error;
}