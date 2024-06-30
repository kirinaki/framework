<?php

namespace Kirinaki\Framework\Fieldsets;

class Container
{
    public static function template(string $page, string $label): \Carbon_Fields\Container\Container
    {
        return \Carbon_Fields\Container::make("post_meta", $label)
            ->where('post_type', '=', 'page')
            ->where('post_template', '=', "templates/{$page}.php");
    }

    public static function postType(string $name, string $label): \Carbon_Fields\Container\Container
    {
        return \Carbon_Fields\Container::make("post_meta", $label)
            ->where('post_type', '=', $name);
    }

    public static function theme(string $name, string $label): \Carbon_Fields\Container\Container
    {
        return \Carbon_Fields\Container::make("theme_options", $label);
    }

}
