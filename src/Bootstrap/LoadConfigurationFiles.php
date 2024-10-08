<?php

namespace Kirinaki\Framework\Bootstrap;

use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;

class LoadConfigurationFiles
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }


    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function run(): void
    {
        $this->app->set("configuration", [
            "app" => require $this->app->get("root_path") . "/config/app.php"
        ]);
    }

}
