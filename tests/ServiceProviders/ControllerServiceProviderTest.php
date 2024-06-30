<?php


it('should works', function () {
    $app = new \DI\Container();
    $serviceProvider = new \Tests\Fixtures\TestControllerServiceProviderFixture($app);

    $serviceProvider->register();
    expect($serviceProvider)->toBeInstanceOf(\Kirinaki\Framework\ServiceProviders\ServiceProvider::class);
});
