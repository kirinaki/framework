<?php

namespace Kirinaki\Framework\Adapters\PHP;

class FileSystemAdapter
{
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }

    public static function get(string $file): false|string
    {
        return file_get_contents($file);
    }
}