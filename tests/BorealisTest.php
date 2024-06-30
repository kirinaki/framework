<?php

use DI\Container;
use Kirinaki\Framework\Bootstrap\LoadConfigurationFiles;
use Twig\Loader\FilesystemLoader;

it('should works', function () {

    $mockLoadConfigFiles = Mockery::mock(LoadConfigurationFiles::class);
    $mockLoadConfigFiles->shouldReceive("run")->andReturn();

    $mockFileSysyem = Mockery::mock(FilesystemLoader::class);
    $mockFileSysyem->shouldReceive("setPaths")->andReturn();

    $container = new Container(
        [
            "root_path" => __DIR__,
            "configuration" => [
                "app" => [
                    "debug" => true,
                    "timezone" => 'America/Mexico_City',

                    "providers" => [
                        \Tests\Fixtures\TestControllerServiceProviderFixture::class
                    ]
                ]
            ],
            LoadConfigurationFiles::class => $mockLoadConfigFiles,
            FilesystemLoader::class => $mockFileSysyem
        ]
    );

    $borealis = new \Kirinaki\Framework\Borealis($container);
    $borealis->boot();
    expect(true)->toBeTrue();
});
