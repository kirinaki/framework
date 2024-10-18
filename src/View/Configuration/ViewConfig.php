<?php

namespace Kirinaki\Framework\View\Configuration;

class ViewConfig
{
    public function __construct(private string $viewPath, private array $functions = [])
    {
    }

    public function getViewPath(): string
    {
        return $this->viewPath;
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }
}