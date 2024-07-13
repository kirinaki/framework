<?php

namespace Kirinaki\Framework\Facades;

/**
 * @method static get($key): mixed
 */
class App extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return "DI\Container";
    }
}
