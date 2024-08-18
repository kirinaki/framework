<?php

namespace Kirinaki\Framework\Strategies;

use Kirinaki\Framework\Attributes\Action;
use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Models\ClassMeta;

class OnlyMethodsStrategy implements Strategy
{
    public function run(ClassMeta $classMeta, Discoverable $controller): void
    {
        foreach ($classMeta->getMethods() as $method => $attributes) {

            if ($classMeta->getMethod($method)->hasAttribute(Action::class)) {
                $action = $classMeta->getMethodAttribute($method, Action::class);
                add_action($action->getHook(), [$controller, $method], $action->getPriority(), $action->getAcceptedArgs());
                return;
            }
        }
    }
}