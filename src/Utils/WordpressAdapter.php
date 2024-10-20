<?php

namespace Kirinaki\Framework\Utils;

class WordpressAdapter
{
    public function add_action(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1): true
    {
        return add_action($hook_name, $callback, $priority, $accepted_args);
    }

    public function wp_enqueue_script(string $handle, string $src = "", array $deps = [], string|bool|null $ver = false, array|bool $args = [])
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $args);
    }

    public function wp_enqueue_style(string $handle, string $src = "", array $deps = [], string|bool|null $ver = false, string $media = "all")
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }

    public function add_filter(string $hook_name, callable $callback, int $priority = 10, int $accepted_args = 1): true
    {
        return add_filter($hook_name, $callback, $priority, $accepted_args);
    }
}