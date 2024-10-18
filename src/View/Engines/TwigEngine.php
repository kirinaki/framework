<?php

namespace Kirinaki\Framework\View\Engines;

use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\View\Configuration\ViewConfig;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEngine implements Engine
{
    private Environment $twig;

    public function __construct(private Application $app, private ViewConfig $viewConfig)
    {
        $this->configure();
    }

    private function configure(): void
    {
        $loader = new FilesystemLoader($this->viewConfig->getViewPath());
        $this->twig = new Environment($loader);

        foreach ($this->viewConfig->getFunctions() as $function) {
            $this->twig->addFunction($this->app->make($function)->handle());
        }
    }

    public function render(string $file, array $data = []): string
    {
        return $this->twig->render($file, $data);
    }

    public function registerFunction($function): void
    {
        $this->twig->addFunction($function);
    }
}