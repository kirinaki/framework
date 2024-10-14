<?php

namespace Kirinaki\Framework\Support\Facades;

class Vite extends Facade
{

    protected static function getFacadeAccessor()
    {
        return \Kirinaki\Framework\View\Vite::class;
    }
}