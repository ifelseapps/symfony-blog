<?php

namespace App\Core\Infrastructure\Events;

use App\Blog\Application\UseCases\Dto\BaseOutputDto;
use App\Blog\Application\UseCases\Dto\ErrorDto;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionEventListener
{
    public function __construct(protected ExceptionParametersService $settings)
    {
    }

    public function __invoke(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $output = new BaseOutputDto();
        $output->success = false;
        $output->error = ErrorDto::createFromException($exception);

        $settings = $this->settings->resolve(get_class($exception));
        $code = $settings ? $settings['code'] : 500;
        $response = new JsonResponse($output, $code);
        $event->setResponse($response);
    }
}