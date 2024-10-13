<?php

namespace Kirinaki\Framework\Adapters\Wordpress;

class WordpressAdapter
{
    public function action(string $hook, callable $callback, int $priority = 10, int $acceptedArgs = 1): bool
    {
        add_action($hook, $callback, $priority, $acceptedArgs);
        return true;
    }

    public function filter(string $hook, callable $callback, int $priority = 10, int $acceptedArgs = 1): bool
    {
        return add_filter($hook, $callback, $priority, $acceptedArgs);
    }

    public function escapeUrl(string $url, array $protocols = null, string $context = "display"): string
    {
        return esc_url($url, $protocols, $context);
    }

    public function getThemeFileUri(string $file = ""): string
    {
        return get_theme_file_uri($file);
    }

    public function registerRestRoute(string $namespace, string $route, array $arguments): bool
    {
        register_rest_route($namespace, $route, $arguments);
        return true;
    }

    public function registerPostType(string $name, array $arguments)
    {
        return register_post_type($name, $arguments);
    }

    public function currentUserCan(string $value): bool
    {
        return current_user_can($value);
    }

    public function remoteGet(string $url, array $args = [])
    {
        return wp_remote_get($url, $args);
    }

    public function enqueueScript(string $handle, string $src = "", $deps = [], string|bool|null $ver = false, array|bool $args = false): void
    {
        wp_enqueue_script($handle, $src, $deps, $ver, $args);
    }

    public function enqueueStyle(string $handle, string $src = "", $deps = [], string|bool|null $ver = false, string $media = "all"): void
    {
        wp_enqueue_style($handle, $src, $deps, $ver, $media);
    }


}