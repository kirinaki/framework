<?php

namespace Kirinaki\Framework\Application;

use DI\Container;
use Kirinaki\Framework\Application\Configuration\ApplicationBuilder;
use Kirinaki\Framework\Application\Configuration\ApplicationConfig;
use Kirinaki\Framework\Support\Facades\Facade;
use Kirinaki\Framework\Utils\WordpressAdapter;
use function DI\autowire;

class Application extends Container
{
    const VERSION = '0.5.0';

    public function __construct(protected ApplicationConfig $applicationConfig)
    {
        parent::__construct();
        $this->registerBasics();
    }

    protected function registerBasics(): void
    {
        $this->set(Application::class, $this);
        $this->set(ApplicationConfig::class, $this->applicationConfig);
        $this->set(WordpressAdapter::class, autowire());
        Facade::setFacadeApplication($this);
    }

    public static function configure(ApplicationConfig $applicationConfig): ApplicationBuilder
    {
        return new ApplicationBuilder(new static($applicationConfig));
    }
}