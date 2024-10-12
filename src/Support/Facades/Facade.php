<?php

namespace Kirinaki\Framework\Support\Facades;

use Kirinaki\Framework\Application;

abstract class Facade
{
    protected static Application $app;

    abstract protected static function getFacadeAccessor();

    public static function setFacadeApplication(Application $app): void
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