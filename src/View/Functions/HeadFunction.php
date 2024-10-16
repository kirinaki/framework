<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Support\Facades\Wordpress;
use Twig\TwigFunction;

class HeadFunction extends ViewFunction
{
    function handle(): TwigFunction
    {
        return new TwigFunction('wp_head', function () {
            Wordpress::doAction('wp_head');
        });
    }
}