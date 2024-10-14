<?php

namespace Kirinaki\Framework\View;

use Kirinaki\Framework\Support\Facades\App;
use Kirinaki\Framework\Support\Facades\Storage;
use Kirinaki\Framework\Support\Facades\Wordpress;

class Vite
{
    private string $host = "http://localhost";
    private int $port = 5173;
    private array $entrypoints = [
        "/resources/css/main.css",
        "/resources/js/main.ts"
    ];
    private string $manifestPath = "/dist/manifest.json";

    public function withHost(string $host)
    {
        $this->host = $host;
        return $this;
    }

    public function withPort(int $port)
    {
        $this->port = $port;
        return $this;
    }

    public function withEntrypoints(array $entrypoints)
    {
        $this->entrypoints = $entrypoints;
    }

    public function useManifest(string $manifest)
    {
        $this->manifestPath = $manifest;
        return $this;
    }


    public function register()
    {

        Wordpress::action("wp_enqueue_scripts", function () {
            $config = App::get("config");
            $manifestPath = $config["publicPath"] . $this->manifestPath;
            $fullUrl = "{$this->host}:{$this->port}";

            if (is_array(Wordpress::remoteGet($fullUrl))) {
                Wordpress::enqueueScript("vite", $fullUrl . "/@vite/client", [], null);
                foreach ($this->entrypoints as $key => $entrypoint) {
                    if (str_ends_with($entrypoint, ".css") || str_ends_with($entrypoint, ".scss") || str_ends_with($entrypoint, ".sass")) {
                        Wordpress::enqueueStyle("module-$key", $fullUrl . $entrypoint, [], 'null');
                    } else {
                        Wordpress::enqueueStyle("module-$key", $fullUrl . $entrypoint, ['jquery'], null, true);
                    }
                }

            } elseif (Storage::exists($manifestPath)) {
                $manifest = json_decode(Storage::get($manifestPath), true);
                foreach ($this->entrypoints as $key => $entrypoint) {
                    if (str_ends_with($entrypoint, ".css") || str_ends_with($entrypoint, ".scss") || str_ends_with($entrypoint, ".sass")) {
                        Wordpress::enqueueStyle("module-$key", Wordpress::getThemeFileUri("public/dist/{$manifest[substr($entrypoint,1)]['file']}"), [], null);
                    } else {
                        Wordpress::enqueueScript("module-$key", Wordpress::getThemeFileUri("public/dist/{$manifest[substr($entrypoint,1)]['file']}"), ['jquery'], null, true);
                    }
                }
            }
        });

        Wordpress::filter('script_loader_tag', function (string $tag, string $handle, string $src) {
            if (in_array($handle, ['vite', 'main-js'])) {
                return '<script type="module" src="' . Wordpress::escapeUrl($src) . '" defer></script>';
            }
            return $tag;
        }, 10, 3);
    }
}