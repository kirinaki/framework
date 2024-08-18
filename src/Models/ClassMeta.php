<?php

namespace Kirinaki\Framework\Models;

class ClassMeta
{

    private string $className;
    private string $name;
    private array $attributes = [];
    private array $methods = [];

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getMethod(string $key): MethodMeta
    {
        return $this->methods[$key];
    }

    public function getMethods(): array
    {
        return $this->methods;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function addAttribute(string $key, mixed $attributes): void
    {
        $this->attributes[$key] = $attributes;
    }

    public function addMethod(string $key, MethodMeta $method): void
    {
        $this->methods[$key] = $method;
    }

    public function getAttribute(string $key)
    {
        return $this->attributes[$key] ?? null;
    }

    public function hasAttribute(string $attribute): bool
    {
        return array_key_exists($attribute, $this->attributes);
    }

    public function getMethodAttribute(string $method, string $attribute)
    {
        return $this->getMethod($method)->getAttribute($attribute) ?? null;
    }

}