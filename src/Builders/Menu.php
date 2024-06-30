<?php

namespace Kirinaki\Framework\Builders;

use Kirinaki\Framework\Wordpress\Walkers\Walker;

class Menu
{
    private Walker $walker;
    private string $theme_location;
    private string $menu_id;

    public function __construct()
    {
        $this->walker = new Walker();
    }

    public function withWalker(Walker $walker): static
    {
        $this->walker = $walker;
        return $this;
    }

    public function whereThemeLocation(string $location): static
    {
        $this->theme_location = $location;
        return $this;
    }

    public function whereId(string $id): static
    {
        $this->menu_id = $id;
        return $this;
    }

    public function get(): Walker
    {

        $options = [];
        $options["echo"] = false;
        $options["walker"] = $this->walker;

        if (isset($this->theme_location)) {
            $options["theme_location"] = $this->theme_location;
        }

        if (isset($this->menu_id)) {
            $options["menu_id"] = $this->menu_id;
        }

        wp_nav_menu($options);

        return $this->walker;
    }
}
