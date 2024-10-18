<?php

namespace Kirinaki\Framework\Application\Configuration;

use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\Discovery\Configuration\DiscoveryConfig;
use Kirinaki\Framework\Discovery\Discovery;
use Kirinaki\Framework\View\Configuration\ViewConfig;
use Kirinaki\Framework\View\Engines\Engine;
use Kirinaki\Framework\View\Engines\TwigEngine;
use function DI\get;

class ApplicationBuilder
{
    public function __construct(protected Application $app)
    {
    }

    public function themeSetup(array $discoverables = [], array $functions = [])
    {
        $baseConfig = $this->app->get(ApplicationConfig::class);
        $this->enableViews(new ViewConfig(viewPath: $baseConfig->getBasePath() . "/resources/views", functions: array_merge($functions, [
            \Kirinaki\Framework\View\Functions\HeadFunction::class,
            \Kirinaki\Framework\View\Functions\FooterFunction::class,
            \Kirinaki\Framework\View\Functions\BodyClassFunction::class,
        ])));
        $this->enableDiscovery(new DiscoveryConfig(discoverables: $discoverables));
        return $this;
    }

    public function enableViews(ViewConfig $viewConfig): static
    {
        $this->app->set(ViewConfig::class, $viewConfig);
        $this->app->set(Engine::class, get(TwigEngine::class));
        return $this;
    }

    public function enableDiscovery(DiscoveryConfig $discoveryConfig): self
    {
        $this->app->set(DiscoveryConfig::class, $discoveryConfig);
        $discovery = $this->app->make(Discovery::class);

        foreach ($discoveryConfig->getDiscoverables() as $class) {
            $discovery->explore($this->app->make($class));
        }
        return $this;
    }

    public function create(): Application
    {
        return $this->app;
    }
}