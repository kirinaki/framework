<?php

namespace Kirinaki\Framework\Resolvers;

use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Discovery\ClassDiscovery;
use Kirinaki\Framework\Factories\StrategyFactory;

class Resolver
{
    private Discoverable $controller;

    public function __construct(Discoverable $controller)
    {
        $this->controller = $controller;

    }

    public static function make(Discoverable $class): void
    {
        $resolver = new self($class);
        $resolver->run();
    }

    public function run(): void
    {
        $discovery = new ClassDiscovery();
        $factory = new StrategyFactory();

        $classMeta = $discovery->explore($this->controller);
        $strategy = $factory->generate($classMeta);
        $strategy->run($classMeta, $this->controller);
    }

}