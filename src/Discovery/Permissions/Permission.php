<?php

namespace Kirinaki\Framework\Discovery\Permissions;

abstract class Permission
{
    public static function create(): static
    {
        return new static;
    }

    abstract public function evaluate(): bool;
}