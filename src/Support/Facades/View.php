<?php

namespace Kirinaki\Framework\Support\Facades;

use Kirinaki\Framework\View\View as BaseView;

/**
 * @method static void render(string $view, array $data = [])
 */
class View extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return BaseView::class;
    }
}