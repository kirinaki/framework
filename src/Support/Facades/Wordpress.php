<?php

namespace Kirinaki\Framework\Support\Facades;

use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;

class Wordpress extends Facade
{

    protected static function getFacadeAccessor()
    {
        return WordpressAdapter::class;
    }
}