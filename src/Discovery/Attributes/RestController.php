<?php

namespace Kirinaki\Framework\Discovery\Attributes;

use Attribute;
use Kirinaki\Framework\Support\Contracts\Arrayable;

#[Attribute(Attribute::TARGET_CLASS)]
class RestController implements Arrayable
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

    public function toArray(): array
    {
        return [
            "namespace" => $this->namespace,
        ];
    }
}