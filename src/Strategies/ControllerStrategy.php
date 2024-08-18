<?php

namespace Kirinaki\Framework\Strategies;

use Kirinaki\Framework\Attributes\Route;
use Kirinaki\Framework\Attributes\Visibility;
use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Models\ClassMeta;

class ControllerStrategy implements Strategy
{

    public function run(ClassMeta $classMeta, Discoverable $controller): void
    {
        foreach ($classMeta->getMethods() as $method => $attribute) {
            $visibility = "both";
            $path = $classMeta->getMethodAttribute($method, Route::class)->getPath();

            if ($classMeta->getMethod($method)->hasAttribute(Visibility::class)) {
                $visibility = $classMeta->getMethodAttribute($method, Visibility::class)->getVisibility();
            }

            if ($visibility == "both") {
                add_action("admin_post_nopriv_{$path}", [$controller, $method]);
                add_action("admin_post_{$path}", [$controller, $method]);
            } elseif ($visibility == "private") {
                add_action("admin_post_$path", [$controller, $method]);
            } elseif ($visibility == "public") {
                add_action("admin_post_nopriv_$path", [$controller, $method]);
            }

        }
    }
}