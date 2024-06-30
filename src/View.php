<?php

namespace Kirinaki\Framework;

use Kirinaki\Framework\Contracts\Registrable;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use Kirinaki\Framework\Facades\Config;

class View
{
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    private function setupBaseFunctions(): void
    {
        $this->twig->addFunction(new TwigFunction('wp_head', function () {
            do_action('wp_head');
        }));

        $this->twig->addFunction(new TwigFunction('wp_footer', function () {
            do_action('wp_footer');
        }));

        $this->twig->addFunction(new TwigFunction('body_class', function ($css_class = '') {
            echo sprintf("class=\"%s index-two\"", esc_attr(implode(' ', get_body_class($css_class))));
        }));

        $this->twig->addFunction(new TwigFunction("attach", function ($id) {
            return wp_get_attachment_url($id);
        }));
    }

    public function addFunction(TwigFunction $twigFunction): void
    {
        $this->twig->addFunction($twigFunction);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function make(string $view, $context): string
    {
        return $this->twig->render($view . ".twig", $context);
    }

    public function render(string $view, $context): void
    {
        echo $this->make($view, $context);
    }
}
