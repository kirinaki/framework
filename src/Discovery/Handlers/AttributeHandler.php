<?php

namespace Kirinaki\Framework\Discovery\Handlers;

use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;
use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Support\ClassDefinition;

abstract class AttributeHandler
{
    protected WordpressAdapter $wordpress;

    public function __construct(WordpressAdapter $wordpress)
    {
        $this->wordpress = $wordpress;
    }

    abstract public function handle(Discoverable $class, ClassDefinition $classDefinition, string $function, $attribute): void;
}