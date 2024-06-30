<?php

namespace Kirinaki\Framework\ServiceProviders;

abstract class ThemeSupportServiceProvider extends ServiceProvider
{
    private array $themeSupports = [];

    public function register(): void
    {
        $this->boot();
        $this->createPostTypes();
    }

    public function add($themeSupport): void
    {
        $this->themeSupports[] = $themeSupport;
    }

    private function createPostTypes(): void
    {
        foreach ($this->themeSupports as $item) {
            (new $item())->register();
        }
    }
}
