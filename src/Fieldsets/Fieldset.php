<?php

namespace Kirinaki\Framework\Fieldsets;

use Kirinaki\Framework\Contracts\Registrable;

abstract class Fieldset implements Registrable
{
    public function register(): void
    {
        add_action('carbon_fields_register_fields', [$this, "handle"]);
    }

    abstract public function handle();
}
