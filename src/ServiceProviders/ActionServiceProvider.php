<?php

namespace Kirinaki\Framework\ServiceProviders;

abstract class ActionServiceProvider extends ServiceProvider
{
    private array $actions = [];

    public function register(): void
    {
        $this->boot();
        $this->createActions();
    }

    protected function add(string $actionClass): void
    {
        $this->actions[] = $actionClass;
    }

    private function createActions(): void
    {
        foreach ($this->actions as $item) {
            (new $item())->register();
        }
    }
}
