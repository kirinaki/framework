<?php

namespace Kirinaki\Framework\Discovery\Handlers;

use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;

abstract class AttributeHandler
{
    abstract public function handle(Discoverable $class, ClassDefinition $classDefinition, string $function, $attribute): void;
}