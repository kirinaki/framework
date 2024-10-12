<?php

namespace Kirinaki\Framework\Discovery\Handlers;

use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;

class PostTypeHandler extends AttributeHandler
{
    public function handle(Discoverable $class, ClassDefinition $classDefinition, string $function, $attribute): void
    {
        $this->wordpress->action("init", function () use ($attribute, $class, $function) {
            $this->wordpress->registerPostType($attribute->getName(), [$class, $function]);
        });
    }
}