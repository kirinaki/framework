<?php

namespace Tests;

use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;
use Kirinaki\Framework\Application;
use Kirinaki\Framework\ApplicationBuilder;
use PHPUnit\Framework\TestCase;
use Tests\Discovery\Stubs\DiscoverableAsActionStub;
use Tests\Discovery\Stubs\DiscoverableAsPostTypeStub;
use Tests\Discovery\Stubs\DiscoverableAsRestControllerStub;

class BorealisTest extends TestCase
{
    public function test_it_should_return_the_application()
    {
        $app = Application::configure(__DIR__)->create();
        $this->assertInstanceOf(Application::class, $app);
    }

    public function test_it_should_discover_classes()
    {
        $wordpress = \Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnTrue();
        $wordpress->shouldReceive("currentUserCan")->andReturnTrue();

        $app = new Application(__DIR__);
        $app->set(WordpressAdapter::class, $wordpress);

        $appBuilder = new ApplicationBuilder($app);

        $result = $appBuilder->withDiscoverables([
                DiscoverableAsRestControllerStub::class,
                DiscoverableAsPostTypeStub::class,
                DiscoverableAsActionStub::class
            ])
            ->create();

        $this->assertInstanceOf(Application::class, $result);
    }
}