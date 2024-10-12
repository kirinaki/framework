<?php

namespace Kirinaki\Framework\Adapters\Wordpress;

class WordpressAdapter
{
    public function action(string $hook, \Closure $callback, int $priority = 10, int $acceptedArgs = 1): bool
    {
        add_action($hook, $callback, $priority, $acceptedArgs);
        return true;
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


}