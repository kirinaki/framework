<?php

namespace Kirinaki\Framework\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class RestController
{
    private string $namespace;


    public function __construct(string $namespace = "v1")
    {
        $this->namespace = $namespace;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

}