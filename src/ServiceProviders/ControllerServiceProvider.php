<?php

namespace Kirinaki\Framework\ServiceProviders;

use Kirinaki\Framework\Controllers\Controller;

abstract class ControllerServiceProvider extends ServiceProvider
{
    private array $controllers = [];

    public function register(): void
    {
        $this->boot();
        $this->createControllers();
    }

    public function add($controller): void
    {
        $this->controllers[] = $controller;
    }

    private function createControllers(): void
    {
        foreach ($this->controllers as $item) {
            (new $item())->register();
        }
    }
}
