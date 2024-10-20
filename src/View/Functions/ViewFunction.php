<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Application\Application;

abstract class ViewFunction
{
    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    abstract function handle();
}