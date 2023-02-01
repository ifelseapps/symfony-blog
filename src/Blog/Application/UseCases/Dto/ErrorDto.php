<?php

namespace App\Blog\Application\UseCases\Dto;

use Exception;

class ErrorDto
{
    public int $code;

    public string $message;

    public string $class;

    public static function createFromException(Exception $exception): self
    {
        $dto = new ErrorDto();
        $dto->code = $exception->getCode();
        $dto->message = $exception->getMessage();
        $dto->class = get_class($exception);

        return $dto;
    }
}