<?php

namespace Kirinaki\Framework\Application\Configuration;

use Closure;
use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\Discovery\Discovery;
use Kirinaki\Framework\View\Engines\Engine;
use Kirinaki\Framework\View\Engines\TwigEngine;
use Kirinaki\Framework\View\ViewBuilder;

class ApplicationBuilder
{
    private Application $app;


    public function __construct(Application $application)
    {
        $this->app = $application;
    }

    public function enableViews(string $viewsPath, Closure $closure = null): static
    {
        $this->app->set("path.views", $this->app->getBasePath() . $viewsPath);
        $this->app->set("path.public", $this->app->getBasePath() . "/public");
        $viewBuilder = new ViewBuilder();
        if ($closure != null) $closure($viewBuilder);
        $this->app->set(Engine::class, new TwigEngine($this->app, $viewBuilder));
        return $this;
    }

    public function withDiscoverables(array $discoverables): self
    {
        $discovery = $this->app->make(Discovery::class);
        foreach ($discoverables as $class) {
            $discovery->explore(new $class);
        }
        return $this;
    }

    public function create(): Application
    {
        return $this->app;
    }
}