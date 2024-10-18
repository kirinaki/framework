<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Support\Facades\Wordpress;
use Twig\TwigFunction;

class BodyClassFunction extends ViewFunction
{
    function handle(): TwigFunction
    {
        return new TwigFunction('body_class', function ($css_class = '') {
            echo sprintf("class=\"%s\"", esc_attr(implode(' ', get_body_class($css_class))));
        });
    }
}