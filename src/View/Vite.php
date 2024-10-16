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
            $publicPath = App::get("path.public");
            $manifestPath = $publicPath . $this->manifestPath;
            $fullUrl = "{$this->host}:{$this->port}";

            if ($this->isRemoteAvailable($fullUrl)) {
                $this->enqueueViteAssets($fullUrl);
            } elseif (Storage::exists($manifestPath)) {
                $this->enqueueLocalAssets($manifestPath);
            }
        });

        Wordpress::filter('script_loader_tag', function (string $tag, string $handle, string $src) {
            return $this->customScriptTag($tag, $handle, $src);
        }, 10, 3);
    }

    private function isRemoteAvailable(string $fullUrl): bool
    {
        return is_array(Wordpress::remoteGet($fullUrl));
    }

    private function enqueueViteAssets(string $fullUrl): void
    {
        Wordpress::enqueueScript("vite", $fullUrl . "/@vite/client", [], null);
        foreach ($this->entrypoints as $key => $entrypoint) {
            $this->enqueueAsset($key, $entrypoint, $fullUrl);
        }
    }

    private function enqueueLocalAssets(string $manifestPath): void
    {
        $manifest = json_decode(Storage::get($manifestPath), true);
        foreach ($this->entrypoints as $key => $entrypoint) {
            $filePath = "public/dist/{$manifest[substr($entrypoint, 1)]['file']}";
            $this->enqueueAsset($key, $entrypoint, Wordpress::getThemeFileUri($filePath));
        }
    }

    private function enqueueAsset(string $key, string $entrypoint, string $url): void
    {
        if ($this->isStyleFile($entrypoint)) {
            Wordpress::enqueueStyle("module-$key", $url . $entrypoint, [], null);
        } else {
            Wordpress::enqueueScript("module-$key", $url . $entrypoint, ['jquery'], null, true);
        }
    }

    private function isStyleFile(string $entrypoint): bool
    {
        return str_ends_with($entrypoint, ".css") || str_ends_with($entrypoint, ".scss") || str_ends_with($entrypoint, ".sass");
    }

    private function customScriptTag(string $tag, string $handle, string $src): string
    {
        if (in_array($handle, ['vite', 'main-js'])) {
            return '<script type="module" src="' . Wordpress::escapeUrl($src) . '" defer></script>';
        }
        return $tag;
    }
}