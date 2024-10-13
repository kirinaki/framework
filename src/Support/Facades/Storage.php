<?php

namespace Kirinaki\Framework\Support\Facades;

use Kirinaki\Framework\Adapters\PHP\FileSystemAdapter;

class Storage extends Facade
{

    protected static function getFacadeAccessor()
    {
        return FileSystemAdapter::class;
    }
}