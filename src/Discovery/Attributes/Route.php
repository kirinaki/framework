<?php

namespace Kirinaki\Framework\Discovery\Attributes;

use Attribute;
use Illuminate\Support\Collection;
use Kirinaki\Framework\Support\Contracts\Arrayable;

#[Attribute(Attribute::TARGET_METHOD)]
class Route implements Arrayable
{
    private string $method;
    private string $path;
    private Collection $permissions;

    public function __construct(string $path, string $method = "GET", array|Collection $permissions = [])
    {
        $this->method = $method;
        $this->path = $path;
        $this->permissions = $permissions instanceof Collection ? $permissions : collect($permissions);
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function permissions(): Collection
    {
        return $this->permissions;
    }

    public function toArray(): array
    {
        return [
            "method" => $this->method,
            "path" => $this->path,
            "permissions" => $this->permissions,
        ];
    }
}