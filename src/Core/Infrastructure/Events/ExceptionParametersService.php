<?php

namespace App\Core\Infrastructure\Events;

use Symfony\Component\DependencyInjection\Container;

class ExceptionParametersService
{
    /**
     * @var array<string, ExceptionParametersDto>
     */
    protected array $settings = [];

    public function __construct(protected Container $container)
    {
        $parameters = $this->container->getParameter('exceptions');
        foreach ($parameters as $class => $settings) {
            $this->addException($class, $settings['code'], $settings['hidden']);
        }
    }

    public function addException(string $class, int $code, bool $hidden): void {
        $dto = new ExceptionParametersDto();
        $dto->code = $code;
        $dto->hidden = $hidden;

        $this->settings[$class] = $dto;
    }

    public function resolve(string $throwableClass): ExceptionParametersDto | null
    {
        foreach ($this->settings as $class => $settings) {
            if ($class === $throwableClass || is_subclass_of($throwableClass, $class)) {
                return $settings;
            }
        }

        return null;
    }
}