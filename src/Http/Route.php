<?php

namespace Kirinaki\Framework\Http;

class Route
{
    private string $method;
    private string $event;

    public function __construct(string $method, string $event)
    {
        $this->method = $method;
        $this->event = $event;
    }

    public static function post(string $event): self
    {
        return new self(method: "POST", event: $event);
    }

    public static function get(string $event): self
    {
        return new self(method: "GET", event: $event);
    }

    public function method(): string
    {
        return $this->method;
    }

    public function event(): string
    {
        return $this->event;
    }
}
