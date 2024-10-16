<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Support\Facades\Wordpress;
use Twig\TwigFunction;

class BodyClassFunction extends ViewFunction
{
    function handle(): TwigFunction
    {
        return new TwigFunction('body_class', function ($css_class = '') {
            echo sprintf("class=\"%s\"", Wordpress::escapeAttribute(implode(' ', Wordpress::getBodyClass($css_class))));
        });
    }
}