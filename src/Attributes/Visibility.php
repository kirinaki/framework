<?php

namespace Kirinaki\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Visibility
{
    private string $visibility;


    public function __construct(string $visibility)
    {
        $this->visibility = $visibility;
    }

    public function getVisibility(): string
    {
        return $this->visibility;
    }
}