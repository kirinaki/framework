<?php

namespace Kirinaki\Framework\Bootstrap;

use DI\Container;
use Kirinaki\Framework\Facades\Config;
use Kirinaki\Framework\Facades\Facade;

class RegisterFacades
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function run(): void
    {
        Facade::setFacadeApplication($this->app);
    }
}
