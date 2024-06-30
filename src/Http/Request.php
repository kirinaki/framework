<?php

namespace Kirinaki\Framework\Http;

class Request
{
    private string $method;
    private array $data;

    public function __construct(string $method, array $data)
    {
        $this->method = $method;
        $this->data = $data;
    }

    public function method(): string
    {
        return $this->method;
    }

    public function isPOST(): bool
    {
        return $this->method == "POST";
    }

    public function isGET(): bool
    {
        return $this->method == "GET";
    }

    public function data(): array
    {
        return $this->data;
    }

    public function input(string $key)
    {
        return $this->data[$key];
    }
}
