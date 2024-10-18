<?php

namespace Tests;

use Kirinaki\Framework\Application\Application;
use Kirinaki\Framework\Application\Configuration\ApplicationConfig;
use Kirinaki\Framework\Discovery\Configuration\DiscoveryConfig;
use Kirinaki\Framework\View\Configuration\ViewConfig;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;
use Tests\Discovery\Stubs\DiscoverableAsActionStub;
use Tests\Discovery\Stubs\DiscoverableAsPostTypeStub;
use Tests\Discovery\Stubs\DiscoverableAsRestControllerStub;
use Tests\Stubs\Functions\ExampleFunction;

class ApplicationTest extends TestCase
{
    private ApplicationConfig $config;

    protected function setUp(): void
    {
        parent::setUp();
        $this->config = new ApplicationConfig(
            basePath: __DIR__,
            filePath: __FILE__,
            baseUrl: "http://localhost:8000"
        );
    }

    public function test_it_should_return_the_application()
    {
        $app = Application::configure($this->config)->create();
        $this->assertInstanceOf(Application::class, $app);
        $this->assertEquals($this->config, $app->get(ApplicationConfig::class));
    }

    public function test_it_should_enable_discovery_module()
    {
        PHPMockery::mock("\Kirinaki\Framework\Discovery\Permissions", "current_user_can")->andReturnTrue();
        PHPMockery::mock("\Kirinaki\Framework\Discovery\Handlers", "add_action")->andReturnTrue();

        $discoveryConfig = new DiscoveryConfig([
            DiscoverableAsRestControllerStub::class,
            DiscoverableAsActionStub::class,
            DiscoverableAsPostTypeStub::class
        ]);
        $app = Application::configure($this->config)->enableDiscovery($discoveryConfig)->create();
        $this->assertInstanceOf(Application::class, $app);
        $this->assertEquals($discoveryConfig, $app->get(DiscoveryConfig::class));
    }

    public function test_it_should_enable_view_module()
    {
        $viewsConfig = new ViewConfig(
            viewPath: __DIR__ . "/Stubs/Views",
            functions: [
                \Kirinaki\Framework\View\Functions\HeadFunction::class,
                \Kirinaki\Framework\View\Functions\FooterFunction::class,
                \Kirinaki\Framework\View\Functions\BodyClassFunction::class,
                ExampleFunction::class
            ]
        );
        $app = Application::configure($this->config)->enableViews($viewsConfig)->create();
        $this->assertInstanceOf(Application::class, $app);
        $this->assertEquals($viewsConfig, $app->get(ViewConfig::class));
    }


}