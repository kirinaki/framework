<?php

namespace Tests\Fixtures;

use Kirinaki\Framework\ServiceProviders\ControllerServiceProvider;

class TestControllerServiceProviderFixture extends ControllerServiceProvider
{
    public function boot(): void
    {
        $this->add(TestControllerGetFixture::class);
        $this->add(TestControllerPostFixture::class);
    }
}