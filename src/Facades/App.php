<?php

namespace Kirinaki\Framework\Facades;

class App extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "DI\Container";
    }
}
