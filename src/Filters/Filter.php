<?php

namespace Kirinaki\Framework\Filters;

use Kirinaki\Framework\Contracts\Registrable;

abstract class Filter implements Registrable
{
    protected string $hook = "";
    protected int $priority = 10;

    abstract public function handle(): void;

    public function register(): void
    {
        add_filter($this->hook, [ $this, "handle" ], $this->priority);
    }
}
