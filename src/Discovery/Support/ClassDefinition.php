<?php

namespace Kirinaki\Framework\Discovery\Support;

use Illuminate\Support\Collection;

class ClassDefinition
{
    private string $name;
    private Collection $attributes;

    public function __construct(string $name, Collection $attributes)
    {
        $this->name = $name;
        $this->attributes = $attributes;
    }

    public static function create(string $name, Collection $attributes): self
    {
        return new self($name, $attributes);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttribute(string $attribute)
    {
        return $this->attributes[$attribute];
    }

    public function hasAttribute(string $attribute): bool
    {
        return $this->attributes->has($attribute);
    }
}