<?php

namespace Kirinaki\Framework\Wordpress\ThemeSupport;

use Kirinaki\Framework\Contracts\Registrable;

abstract class ThemeSupport implements Registrable
{
    abstract public function definition(): string;

    protected function options()
    {
        return null;
    }

    public function register(): void
    {
        $options = $this->options();
        if ($options == null) {
            add_theme_support($this->definition());
            return;
        }
        add_theme_support($this->definition(), $this->options());
    }
}
