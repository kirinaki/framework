<?php

use Kirinaki\Framework\Fieldsets\Fieldset;
use Kirinaki\Framework\ServiceProviders\FieldsetServiceProvider;

it('should add a new fieldset', function () {
    class TestFieldset extends fieldset
    {
        function handle(): void
        {
        }
    }

    class TestServiceProvider extends FieldsetServiceProvider
    {
        public function boot(): void
        {
            $this->add(TestFieldset::class);
        }
    }


    $app = new \DI\Container();
    $serviceProvider = new TestServiceProvider($app);
    $serviceProvider->register();
    expect($serviceProvider)->toBeInstanceOf(FieldsetServiceProvider::class);
});
