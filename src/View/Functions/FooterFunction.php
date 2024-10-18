<?php

namespace Kirinaki\Framework\View\Functions;

use Kirinaki\Framework\Support\Facades\Wordpress;
use Twig\TwigFunction;

class FooterFunction extends ViewFunction
{
    function handle(): TwigFunction
    {
        return new TwigFunction('wp_footer', function () {
            do_action('wp_footer');
        });
    }
}