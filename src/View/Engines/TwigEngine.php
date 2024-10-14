<?php

namespace Kirinaki\Framework\View\Engines;

use Kirinaki\Framework\Application;
use Kirinaki\Framework\Support\Facades\Vite;
use Kirinaki\Framework\Support\Facades\Wordpress;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class TwigEngine implements Engine
{
    private Application $app;

    private Environment $twig;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->configure();
    }

    private function configure(): void
    {
        $config = $this->app->get("config");
        $loader = new FilesystemLoader($config["basePath"] . "/resources/views");
        $this->twig = new Environment($loader);

        $this->twig->addFunction(new TwigFunction('wp_head', function () {
            Wordpress::doAction('wp_head');
        }));

        $this->twig->addFunction(new TwigFunction('wp_footer', function () {
            Wordpress::doAction('wp_footer');
        }));

        $this->twig->addFunction(new TwigFunction('vite', function () {
            Vite::register();
        }));

        $this->twig->addFunction(new TwigFunction('body_class', function ($css_class = '') {
            echo sprintf("class=\"%s\"", Wordpress::escapeAttribute(implode(' ', Wordpress::getBodyClass($css_class))));
        }));
    }

    public function render(string $file, array $data = []): string
    {
        return $this->twig->render($file, $data);
    }
}