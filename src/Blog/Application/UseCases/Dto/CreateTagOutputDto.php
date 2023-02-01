<?php

namespace App\Blog\Application\UseCases\Dto;

class CreateTagOutputDto
{
    public bool $success;

    public string $id;

    public ErrorDto $error;
}