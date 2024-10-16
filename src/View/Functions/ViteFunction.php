<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Support\Facades\Vite;
use Twig\TwigFunction;

class ViteFunction extends ViewFunction
{
    function handle(): TwigFunction
    {
        return new TwigFunction('vite', function () {
            Vite::register();
        });
    }
}