<?php

namespace Kirinaki\Framework\View\Engines;

use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\View\ViewBuilder;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigEngine implements Engine
{
    private Application $app;
    private ViewBuilder $viewBuilder;

    private Environment $twig;

    public function __construct(Application $app, ViewBuilder $viewBuilder)
    {
        $this->app = $app;
        $this->viewBuilder = $viewBuilder;
        $this->configure();
    }

    private function configure(): void
    {
        $viewPath = $this->app->get("path.views");

        $loader = new FilesystemLoader($viewPath);
        $this->twig = new Environment($loader);

        foreach ($this->viewBuilder->getFunctions() as $function) {
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