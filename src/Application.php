<?php

namespace Kirinaki\Framework;

use DI\Container;
use Kirinaki\Framework\Support\Facades\Facade;

class Application extends Container
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        parent::__construct();
        $this->basePath = $basePath;
        $this->registerBaseBindings();
    }

    protected function registerBaseBindings(): void
    {
        $this->set(Application::class, $this);
        $this->set("config", [
            "basePath" => $this->basePath
        ]);
        Facade::setFacadeApplication($this);
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