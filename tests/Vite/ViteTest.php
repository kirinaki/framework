<?php

namespace Tests\Vite;

use Kirinaki\Framework\Utils\WordpressAdapter;
use Kirinaki\Framework\Vite\Configuration\ViteConfig;
use Kirinaki\Framework\Vite\Vite;
use phpmock\mockery\PHPMockery;
use PHPUnit\Framework\TestCase;

class ViteTest extends TestCase
{
    protected function setUp(): void
    {
        $this->config = new ViteConfig(
            publicPath: "/public",
            entrypoints: ["resources/js/main.ts", "resources/css/main.css"],
            url: "https://example.com/public"
        );
        $this->wordpress = \Mockery::mock(WordpressAdapter::class);
        $this->vite = new Vite($this->config, $this->wordpress);
    }

    protected function tearDown(): void
    {
        \Mockery::close();
    }


    public function test_it_should_enqueue_dev_scripts()
    {
        $fileExists = PHPMockery::mock("\Kirinaki\Framework\Vite", "file_exists")->andReturn(true);

        $this->wordpress->shouldReceive("wp_enqueue_script")->twice();
        $this->wordpress->shouldReceive("wp_enqueue_style")->once();
        $this->wordpress->shouldReceive("add_filter")->once();
        $this->wordpress->shouldReceive("add_action")->andReturnUsing(function ($hook, $callable) {
            $callable(null);
            return true;
        });

        $this->vite->handle();

        $this->assertTrue(true);
    }

    public function test_it_should_enqueue_prod_scripts()
    {
        $this->wordpress->shouldReceive("wp_enqueue_script")->once();
        $this->wordpress->shouldReceive("wp_enqueue_style")->once();
        $this->wordpress->shouldReceive("add_filter")->once();
        $this->wordpress->shouldReceive("add_action")->andReturnUsing(function ($hook, $callable) {
            $callable(null);
            return true;
        });

        $fileExists = PHPMockery::mock(__NAMESPACE__, "file_exists");
        $fileExists->with($this->config->getHotPath())->andReturnFalse();
        $fileExists->with($this->config->getManifestPath())->andReturnTrue();

        $fileContent = PHPMockery::mock("\Kirinaki\Framework\Vite", "file_get_contents");
        $fileContent->with($this->config->getManifestPath())->andReturn('{"resources/css/main.css":{"file":"main-DFej6XZu.css","src":"resources/css/main.css","isEntry":true},"resources/js/main.ts":{"file":"main-C2Sl7i92.js","name":"main","src":"resources/js/main.ts","isEntry":true}}');

        $this->vite->handle();

        $this->assertTrue(true);
    }

    public function test_it_should_enqueue_return_when_the_hooks_is_not_the_same()
    {
        $this->wordpress->shouldReceive("add_action")->andReturnUsing(function ($hook, $callable) {
            $callable("toplevel_page_another-page");
            return true;
        });

        $this->vite->handle(["toplevel_page_mi-plugin-admin"]);
        $this->assertTrue(true);
    }


}