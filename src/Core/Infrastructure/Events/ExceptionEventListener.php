<?php

namespace App\Core\Infrastructure\Events;

use App\Blog\Application\UseCases\Dto\BaseOutputDto;
use App\Blog\Application\UseCases\Dto\ErrorDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionEventListener
{
    public function __construct(protected ExceptionParametersService $settings)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $class = get_class($exception);
        $settings = $this->settings->resolve($class);

        $output = new BaseOutputDto();
        $output->success = false;
        $output->error = new ErrorDto();
        $output->error->message = isset($settings) && $settings->hidden
            ? 'Default error message'
            : $exception->getMessage();
        $output->error->class = isset($settings) && $settings->hidden
            ? null
            : $class;

        $code = isset($settings)
            ? $settings->code
            : Response::HTTP_INTERNAL_SERVER_ERROR;
        $response = new JsonResponse($output, $code);
        $event->setResponse($response);
    }
}