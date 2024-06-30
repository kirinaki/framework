<?php

namespace Kirinaki\Framework\Facades;

/**
 * @method static get(string $key): string|null
 */
class Config extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Kirinaki\Framework\Config::class;
    }
}
