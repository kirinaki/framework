<?php

namespace Kirinaki\Framework;

use DI\Container;
use Kirinaki\Framework\Support\Facades\Facade;
use Kirinaki\Framework\View\Engines\Engine;
use Kirinaki\Framework\View\Engines\TwigEngine;

class Application extends Container
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        parent::__construct();
        $this->basePath = $basePath;
        $this->registerBaseBindings();
        $this->registerViewBindings();
    }

    protected function registerBaseBindings(): void
    {
        $this->set(Application::class, $this);
        $this->set("config", [
            "basePath" => $this->basePath,
            "publicPath" => $this->basePath . "/public",
        ]);
        Facade::setFacadeApplication($this);
    }

    protected function registerViewBindings()
    {
        $this->set(Engine::class, new TwigEngine($this));
    }

    public static function configure(string $basePath): ApplicationBuilder
    {
        return (new ApplicationBuilder(new static($basePath)))->withKernel();
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

}