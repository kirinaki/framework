<?php

use Kirinaki\Framework\Facades\View;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

it('should return an instance of view', function () {
    $app = new \DI\Container();

    $mock = Mockery::mock(\Twig\Environment::class);
    $mock->shouldReceive("render")->andReturn("OK");

    $loader = $app->make(FilesystemLoader::class);
    $loader->setPaths("/");
    $app->set(LoaderInterface::class, $loader);
    $app->set(\Twig\Environment::class, $mock);
    $app->make(\Kirinaki\Framework\View::class);

    View::setFacadeApplication($app);
    $result = View::render("a", ["a"]);
    expect($result)->toBeNull();
});
