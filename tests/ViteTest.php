<?php

namespace Tests;

use Kirinaki\Framework\Adapters\PHP\FileSystemAdapter;
use Kirinaki\Framework\Adapters\Wordpress\WordpressAdapter;
use Kirinaki\Framework\Application;
use Kirinaki\Framework\View\Vite;
use Mockery;
use PHPUnit\Framework\TestCase;

class ViteTest extends TestCase
{
    private Application $app;

    protected function setUp(): void
    {
        $this->app = Application::configure("")->create();
    }

    public function test_it_should_enqueue_scripts_when_the_server_is_running()
    {
        $wordpress = Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnUsing(function ($hook, $callback) {
            $callback();
            return true;
        });
        $wordpress->shouldReceive("remoteGet")->andReturnUsing(function ($url) {
            return [];
        });
        $wordpress->shouldReceive("enqueueScript")->andReturn();
        $wordpress->shouldReceive("enqueueStyle")->andReturn();
        $wordpress->shouldReceive("filter")->andReturnUsing(function ($hook, $callback) {
            $callback("", "vite", "");
            return true;
        });
        $wordpress->shouldReceive("escapeUrl")->andReturn("http://test");

        $this->app->set(WordpressAdapter::class, $wordpress);

        $vite = new Vite();
        $vite->register();
        $this->assertTrue(true);
    }

    public function test_it_should_enqueue_scripts_when_the_manifest_exists()
    {
        $wordpress = Mockery::mock(WordpressAdapter::class);
        $wordpress->shouldReceive("action")->andReturnUsing(function ($hook, $callback) {
            $callback();
            return true;
        });
        $wordpress->shouldReceive("remoteGet")->andReturnUsing(function ($url) {
            return "error";
        });
        $wordpress->shouldReceive("enqueueScript")->andReturn();
        $wordpress->shouldReceive("enqueueStyle")->andReturn();
        $wordpress->shouldReceive("filter")->andReturnUsing(function ($hook, $callback) {
            $callback("", "vite", "");
            return true;
        });
        $wordpress->shouldReceive("escapeUrl")->andReturn("http://test");
        $wordpress->shouldReceive("getThemeFileUri")->andReturn("/wp-content/themes/test");

        $storage = Mockery::mock(FileSystemAdapter::class);
        $storage->shouldReceive("exists")->andReturn(true);
        $storage->shouldReceive("get")->andReturn('{"foo":"bar"}');

        $this->app->set(WordpressAdapter::class, $wordpress);
        $this->app->set(FileSystemAdapter::class, $storage);

        $vite = new Vite();
        $vite->register();
        $this->assertTrue(true);
    }


}