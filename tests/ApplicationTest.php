<?php

namespace Tests;

use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;
use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\Application\Configuration\ApplicationBuilder;
use Kirinaki\Framework\View\ViewBuilder;
use PHPUnit\Framework\TestCase;
use Tests\Discovery\Stubs\DiscoverableAsActionStub;
use Tests\Discovery\Stubs\DiscoverableAsPostTypeStub;
use Tests\Discovery\Stubs\DiscoverableAsRestControllerStub;
use Tests\Stubs\Functions\ExampleFunction;

class ApplicationTest extends TestCase
{
    public function test_it_should_return_the_application()
    {
        $app = Application::configure(__DIR__)->create();
        $this->assertInstanceOf(Application::class, $app);
    }

    public function test_it_should_store_the_base_path_correctly()
    {
        $app = Application::configure(__DIR__)->create();
        $this->assertEquals(__DIR__, $app->get("path.base"));
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

    public function test_it_should_enable_view_engine()
    {
        $app = Application::configure(__DIR__)
            ->enableViews("/Stubs/Views")
            ->create();

        $this->assertEquals(__DIR__ . "/Stubs/Views", $app->get("path.views"));
    }

    public function test_it_should_add_functions_to_view()
    {
        $app = Application::configure(__DIR__)
            ->enableViews("/Stubs/Views", function (ViewBuilder $view) {
                $view->setFunctions([
                    ExampleFunction::class
                ]);
            })
            ->create();

        $this->assertInstanceOf(Application::class, $app);
    }


}