<?php

namespace Kirinaki\Framework\Facades;

/**
 * @method static get(): \Kirikani\Framework\Wordpress\Walkers\Walker
 * @method static whereThemeLocation(string $themeLocation): static
 * @method static whereId(string $id): static
 * @method static withWalker($walker): static
 */
class Menu extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Kirinaki\Framework\Builders\Menu::class;
    }
}
