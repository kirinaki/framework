<?php

namespace Kirinaki\Framework\View;

class ViewBuilder
{
    private array $functions = [];

    public function setFunctions(array $functions): static
    {
        $this->functions = $functions;
        return $this;
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }
}