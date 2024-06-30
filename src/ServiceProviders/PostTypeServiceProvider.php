<?php

namespace Kirinaki\Framework\ServiceProviders;

abstract class PostTypeServiceProvider extends ServiceProvider
{
    private array $postTypes = [];

    public function register(): void
    {
        $this->boot();
        $this->createPostTypes();
    }

    public function add($postType): void
    {
        $this->postTypes[] = $postType;
    }

    private function createPostTypes(): void
    {
        foreach ($this->postTypes as $item) {
            (new $item())->register();
        }
    }
}
