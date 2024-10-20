<?php

if (!function_exists("dd")) {
    function dd($var)
    {
        return dump($var);
    }
}

if (!function_exists("app")) {
    function app($class)
    {
        return \Kirinaki\Framework\Support\Facades\App::make($class);
    }
}