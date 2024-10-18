<?php

namespace Kirinaki\Framework\Discovery\Handlers;

use Kirinaki\Framework\Discovery\Attributes\RestController;
use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;

class RouteHandler extends AttributeHandler
{
    public function handle(Discoverable $class, ClassDefinition $classDefinition, string $function, $attribute): void
    {
        if (!$classDefinition->hasAttribute(RestController::class)) {
            throw new \Exception("Missing RestController attribute");
        }

        $namespace = $classDefinition->getAttribute(RestController::class)->getNamespace();
        $arguments = [
            "method" => $attribute->getMethod(),
            "callback" => [$class, $function],
        ];

        if ($attribute->permissions()->isNotEmpty()) {
            $arguments["permission_callback"] = $attribute->permissions()->every(fn($item) => $item::create()->evaluate());
        }

        add_action("rest_api_init", function () use ($namespace, $attribute, $arguments) {
            register_rest_route($namespace, $attribute->getPath(), $arguments);
        });
    }
}