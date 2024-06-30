<?php

namespace Kirinaki\Framework\Bootstrap;

use DI\Container;
use Kirinaki\Framework\Facades\Config;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class RegisterTwig
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function run(): void
    {
        $loader = $this->app->make(FilesystemLoader::class);
        $loader->setPaths(dirname(__DIR__) . '/resources');

        $twig = new Environment($loader, [
            'debug' => Config::get("app.debug"),
        ]);
        $twig->addExtension(new DebugExtension());

        $twig->addFunction(new TwigFunction('wp_head', function () {
            do_action('wp_head');
        }));

        $twig->addFunction(new TwigFunction('wp_footer', function () {
            do_action('wp_footer');
        }));

        $twig->addFunction(new TwigFunction('body_class', function ($css_class = '') {
            echo sprintf("class=\"%s index-two\"", esc_attr(implode(' ', get_body_class($css_class))));
        }));

        $twig->addFunction(new TwigFunction("wp_attach", function ($id) {
            return wp_get_attachment_url($id);
        }));

        $this->app->set(Environment::class, $twig);
    }

}
