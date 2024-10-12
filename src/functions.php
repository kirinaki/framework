<?php

if (!function_exists("dd")) {
    function dd($var)
    {
        return dump($var);
    }
}