<?php

namespace Kirinaki\Framework\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD)]
class Route
{
    private string $method;
    private string $path;


    public function __construct(string $path, string $method = "GET")
    {
        $this->method = $method;
        $this->path = $path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }


}