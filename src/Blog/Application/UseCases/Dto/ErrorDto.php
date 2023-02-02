<?php

namespace App\Blog\Application\UseCases\Dto;

use Throwable;

class ErrorDto
{
    public string $message;

    public string $class;

    public static function createFromException(Throwable $exception): self
    {
        $dto = new ErrorDto();
        $dto->message = $exception->getMessage();
        $dto->class = get_class($exception);

        return $dto;
    }
}