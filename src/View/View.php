<?php

namespace Kirinaki\Framework\View;

use Kirinaki\Framework\View\Engines\Engine;

class View
{
    private Engine $engine;

    public function __construct(Engine $engine)
    {
        $this->engine = $engine;
    }


    public function render(string $view, array $data = []): void
    {
        echo $this->engine->render($view . ".twig", $data);
    }

    public function make(string $view, array $data = []): string
    {
        return $this->engine->render($view . ".twig", $data);
    }
}