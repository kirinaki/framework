<?php

namespace Kirinaki\Framework\ServiceProviders;

abstract class FilterServiceProvider extends ServiceProvider
{
    private array $instances = [];

    public function register(): void
    {
        $this->boot();
        $this->createInstances();
    }

    protected function add(string $instance): void
    {
        $this->instances[] = $instance;
    }

    private function createInstances(): void
    {
        foreach ($this->instances as $item) {
            (new $item())->register();
        }
    }
}
