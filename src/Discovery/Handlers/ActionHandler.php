<?php

namespace Kirinaki\Framework\Discovery\Handlers;

use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;

class ActionHandler extends AttributeHandler
{
    public function handle(Discoverable $class, ClassDefinition $classDefinition, string $function, $attribute): void
    {
        $this->wordpress->action(
            $attribute->getHook(),
            fn() => [$class, $function],
            $attribute->getPriority(),
            $attribute->getAcceptedArgs()
        );
    }
}