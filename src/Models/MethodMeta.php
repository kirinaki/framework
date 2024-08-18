<?php

namespace Kirinaki\Framework\Models;

class MethodMeta
{
    private string $name;
    private array $attributes;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function addAttribute(string $key, mixed $attribute): void
    {
        $this->attributes[$key] = $attribute;
    }

    public function hasAttribute(string $key): bool
    {
        return array_key_exists($key, $this->attributes);
    }

}