<?php

namespace Kirinaki\Framework;

use DI\Container;

class Config
{
    private Container $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function get(string $key)
    {
        $config = $this->app->get("configuration");

        if (empty($key)) {
            return null;
        }

        $segments = explode(".", $key);

        foreach ($segments as $segment) {
            if (!is_array($config) || !array_key_exists($segment, $config)) {
                return null;
            }
            $config = $config[$segment];
        }

        return $config;
    }
}
