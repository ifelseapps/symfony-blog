<?php

namespace App\Core\Infrastructure\Events;

use Symfony\Component\DependencyInjection\Container;

class ExceptionParametersService
{
    protected array $settings = [];

    public function __construct(protected Container $container)
    {
        $parameters = $this->container->getParameter('exceptions');
        foreach ($parameters as $class => $settings) {
            $this->addSetting($class, $settings['code']);
        }
    }

    public function addSetting(string $class, int $code): void {
        $this->settings[$class] = [
            'code' => $code,
        ];
    }

    /** @todo использовать dto для хранения настроек для поддержки типизации */
    public function resolve(string $throwableClass): array | null
    {
        foreach ($this->settings as $class => $settings) {
            if ($class === $throwableClass || is_subclass_of($throwableClass, $class)) {
                return $settings;
            }
        }

        return null;
    }
}