<?php

namespace Tests\Stubs\Functions;

use Kirinaki\Framework\View\Functions\ViewFunction;
use Twig\TwigFunction;

class ExampleFunction extends ViewFunction
{
    public function handle(): TwigFunction
    {
        return new TwigFunction('foo', function () {
            return 'foo';
        });
    }
}