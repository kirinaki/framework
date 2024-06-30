<?php

namespace Kirinaki\Framework\Bootstrap;

use DI\Container;
use Kirinaki\Framework\Facades\Config;

class BootProviders
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function run(): void
    {
        foreach (Config::get("app.providers") as $serviceProvider) {
            (new $serviceProvider($this->app))->register();
        }
    }

}
