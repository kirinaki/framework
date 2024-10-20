<?php

namespace Kirinaki\Framework\Discovery;


use Illuminate\Support\Collection;
use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\Discovery\Attributes\Action;
use Kirinaki\Framework\Discovery\Attributes\PostType;
use Kirinaki\Framework\Discovery\Attributes\Route;
use Kirinaki\Framework\Discovery\Configuration\DiscoveryConfig;
use Kirinaki\Framework\Discovery\Handlers\ActionHandler;
use Kirinaki\Framework\Discovery\Handlers\PostTypeHandler;
use Kirinaki\Framework\Discovery\Handlers\RouteHandler;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;
use ReflectionClass;

class Discovery
{
    private Application $app;

    private array $defaultHandlers = [
        Route::class => RouteHandler::class,
        PostType::class => PostTypeHandler::class,
        Action::class => ActionHandler::class,
    ];

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function explore(Discoverable $class): void
    {
        $reflection = new ReflectionClass($class);
        $classDefinition = ClassDefinition::create($reflection->getName(), $this->exploreClassAttributes($reflection));
        $handlers = array_merge($this->defaultHandlers, $this->app->get(DiscoveryConfig::class)->getHandlers());

        foreach ($reflection->getMethods() as $method) {
            foreach ($method->getAttributes() as $attribute) {

                $handler = $handlers[$attribute->getName()] ?? null;

                if ($handler) {
                    $this->app->make($handler)->handle(
                        $class,
                        $classDefinition,
                        $method->getName(),
                        $attribute->newInstance()
                    );
                }
            }
        }

    }

    private function exploreClassAttributes(ReflectionClass $reflection): Collection
    {
        $classAttributes = collect();
        foreach ($reflection->getAttributes() as $attribute) {
            $classAttributes[$attribute->getName()] = $attribute->newInstance();
        }
        return $classAttributes;
    }
}