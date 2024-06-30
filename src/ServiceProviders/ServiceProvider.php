<?php

namespace Kirinaki\Framework\ServiceProviders;

use DI\Container;
use Kirinaki\Framework\Contracts\Registrable;

abstract class ServiceProvider implements Registrable
{
    protected Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function boot(): void
    {

    }
}
