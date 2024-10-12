<?php

namespace Kirinaki\Framework\Discovery\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class PostType
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}