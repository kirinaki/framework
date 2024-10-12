<?php

namespace Discovery;


use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;
use Kirinaki\Framework\Application;
use Kirinaki\Framework\Discovery\Discovery;
use Mockery;
use PHPUnit\Framework\TestCase;
use Tests\Discovery\Stubs\DiscoverableAsActionStub;
use Tests\Discovery\Stubs\DiscoverableAsPostTypeStub;
use Tests\Discovery\Stubs\DiscoverableAsRestControllerStub;

class DiscoveryTest extends TestCase
{
    private Application $app;

    protected function setUp(): void
    {
        $this->app = Application::configure("")->create();
    }

    public function test_it_should_works_with_rest_controllers()
    {
        $wordpress = Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnTrue();
        $wordpress->shouldReceive("currentUserCan")->andReturnTrue();

        $this->app->set(WordpressAdapter::class, $wordpress);

        $discovery = new Discovery($this->app);
        $discovery->explore(new DiscoverableAsRestControllerStub());
        $this->assertTrue(true);
    }

    public function test_it_should_works_with_custom_post_types()
    {
        $wordpress = Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnTrue();

        $this->app->set(WordpressAdapter::class, $wordpress);

        $discovery = new Discovery($this->app);
        $discovery->explore(new DiscoverableAsPostTypeStub());
        $this->assertTrue(true);
    }

    public function test_it_should_works_with_actions()
    {
        $wordpress = Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnTrue();

        $this->app->set(WordpressAdapter::class, $wordpress);

        $discovery = new Discovery($this->app);
        $discovery->explore(new DiscoverableAsActionStub);
        $this->assertTrue(true);
    }
}