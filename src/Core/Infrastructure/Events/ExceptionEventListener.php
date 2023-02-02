<?php

namespace App\Core\Infrastructure\Events;

use App\Blog\Application\UseCases\Dto\BaseOutputDto;
use App\Blog\Application\UseCases\Dto\ErrorDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionEventListener
{
    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $output = new BaseOutputDto();
        $output->success = false;
        $output->error = ErrorDto::createFromException($exception);

        $response = new JsonResponse($output, Response::HTTP_BAD_REQUEST);
        $event->setResponse($response);
    }
}