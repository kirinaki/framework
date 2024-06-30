<?php

namespace Kirinaki\Framework;

use DI\Container;
use Kirinaki\Framework\Bootstrap\BootProviders;
use Kirinaki\Framework\Bootstrap\LoadConfigurationFiles;
use Kirinaki\Framework\Bootstrap\RegisterFacades;
use Kirinaki\Framework\Bootstrap\RegisterTwig;

class Borealis
{
    private Container $app;

    public function __construct(Container $container)
    {
        $this->app = $container;
    }

    public function boot(): void
    {
        $this->app->make(RegisterFacades::class)->run();
        $this->app->make(LoadConfigurationFiles::class)->run();
        $this->app->make(RegisterTwig::class)->run();
        $this->app->make(BootProviders::class)->run();
    }

    public static function start(string $root): void
    {
        $app = new Container([
            "root_path" => $root,
        ]);
        (new Borealis($app))->boot();
    }
}
