<?php

namespace Kirinaki\Framework\Strategies;

use Kirinaki\Framework\Attributes\Policies;
use Kirinaki\Framework\Attributes\RestController;
use Kirinaki\Framework\Attributes\Route;
use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Models\ClassMeta;

class RestControllerStrategy implements Strategy
{

    public function run(ClassMeta $classMeta, Discoverable $controller): void
    {
        add_action('rest_api_init', function () use ($classMeta, $controller) {
            foreach ($classMeta->getMethods() as $method => $attribute) {
                $args = [
                    "methods" => $classMeta->getMethodAttribute($method, Route::class)->getMethod(),
                    "callback" => [$controller, $method],
                ];

                if ($classMeta->getMethod($method)->hasAttribute(Policies::class)) {
                    $args["permission_callback"] = [$classMeta->getMethodAttribute($method, Policies::class), "evaluate"];
                }

                register_rest_route(
                    route_namespace: $classMeta->getAttribute(RestController::class)->getNamespace(),
                    route: $classMeta->getMethodAttribute($method, Route::class)->getPath(),
                    args: $args
                );
            }
        });
    }
}