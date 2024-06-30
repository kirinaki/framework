<?php

namespace Kirinaki\Framework\Actions;

use Kirinaki\Framework\Contracts\Registrable;

abstract class Action implements Registrable
{
    protected string $hook = "init";

    public function register(): void
    {
        add_action($this->hook, [ $this, "handle" ]);
    }

    abstract public function handle(): void;
}
