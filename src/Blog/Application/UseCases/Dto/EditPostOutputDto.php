<?php

namespace App\Blog\Application\UseCases\Dto;

class EditPostOutputDto
{
    public bool $success;

    public string $id;

    public ErrorDto $error;
}