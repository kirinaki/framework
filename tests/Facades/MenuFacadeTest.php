<?php

use Kirinaki\Framework\Facades\Menu;
use Kirinaki\Framework\Wordpress\Walkers\HierarchicalWalker;
use Kirinaki\Framework\Wordpress\Walkers\Walker;

it('should return a walker without configuration', function () {

    \Brain\Monkey\Functions\expect("wp_nav_menu");
    $app = new \DI\Container();

    Menu::setFacadeApplication($app);

    $result = Menu::get();

    expect($result)->toBeInstanceOf(Walker::class);

});

it('should return a walker with custom walker', function () {

    \Brain\Monkey\Functions\expect("wp_nav_menu");
    $app = new \DI\Container();

    Menu::setFacadeApplication($app);

    $result = Menu::withWalker(new HierarchicalWalker())->get();

    expect($result)->toBeInstanceOf(HierarchicalWalker::class);

});

it('should return a walker with theme location', function () {

    \Brain\Monkey\Functions\expect("wp_nav_menu");
    $app = new \DI\Container();

    Menu::setFacadeApplication($app);

    $result = Menu::whereThemeLocation("test")->get();

    expect($result)->toBeInstanceOf(Walker::class);

});


it('should return a walker with id', function () {

    \Brain\Monkey\Functions\expect("wp_nav_menu");
    $app = new \DI\Container();

    Menu::setFacadeApplication($app);

    $result = Menu::whereId("test")->get();

    expect($result)->toBeInstanceOf(Walker::class);

});