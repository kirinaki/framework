<?php

namespace Kirinaki\Framework\Bootstrap;

use DI\Container;

class BootCarbonFields
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }
    public function run(): void
    {
        add_action('after_setup_theme', function () {
            \Carbon_Fields\Carbon_Fields::boot();
        });
    }
}
