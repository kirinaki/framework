<?php

namespace Kirinaki\Framework\Facades;

use DI\Container;

abstract class Facade
{
    protected static Container $app;

    abstract protected static function getFacadeAccessor();

    public static function setFacadeApplication(Container $app): void
    {
        static::$app = $app;
    }

    public static function __callStatic($method, $args)
    {
        $instance = static::$app;
        $resolvedService = $instance->get(static::getFacadeAccessor());
        return $resolvedService->$method(...$args);
    }
}
