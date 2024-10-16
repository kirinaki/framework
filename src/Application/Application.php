<?php

namespace Kirinaki\Framework\Application;

use DI\Container;
use Kirinaki\Framework\Application\Configuration\ApplicationBuilder;
use Kirinaki\Framework\Support\Facades\Facade;

class Application extends Container
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        parent::__construct();
        $this->setBasePath($basePath);
        $this->registerBaseBindings();
    }

    public function setBasePath(string $basePath): static
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    protected function registerBaseBindings(): void
    {
        $this->set(Application::class, $this);
        Facade::setFacadeApplication($this);
        $this->set("path.base", $this->basePath);
    }

    public static function configure(string $basePath): ApplicationBuilder
    {
        return (new ApplicationBuilder(new static($basePath)));
    }
}