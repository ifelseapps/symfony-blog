<?php

namespace App\Blog\Application\UseCases\Dto;

use Throwable;

class ErrorDto
{
    public string $message;

    public ?string $class;
}