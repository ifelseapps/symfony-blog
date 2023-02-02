<?php

namespace App\Blog\Application\UseCases\Dto;

class BaseOutputDto
{
    public bool $success;

    public ErrorDto $error;
}