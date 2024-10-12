<?php

namespace Kirinaki\Framework\Support\Facades;

use Kirinaki\Framework\Application;

class App extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Application::class;
    }
}