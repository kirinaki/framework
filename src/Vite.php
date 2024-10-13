<?php

namespace Kirinaki\Framework;

use Kirinaki\Framework\Support\Facades\Storage;
use Kirinaki\Framework\Support\Facades\Wordpress;

class Vite
{
    private string $host = "http://localhost";
    private int $port = 5173;
    private string $entryCss = "main.css";
    private string $entryJs = "main.ts";
    private string $manifestPath = "public/dist/manifest.json";

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

    public function useEntryCss(string $entryCss)
    {
        $this->entryCss = $entryCss;
        return $this;
    }

    public function useEntryJs(string $entryJs)
    {
        $this->entryJs = $entryJs;
        return $this;
    }

    public function useManifest(string $manifest)
    {
        $this->manifestPath = $manifest;
        return $this;
    }


    public function register()
    {

        Wordpress::action("wp_enqueue_scripts", function () {
            $manifestPath = $this->manifestPath;
            $fullUrl = "{$this->host}:{$this->port}";

            if (is_array(Wordpress::remoteGet($fullUrl))) {
                Wordpress::enqueueScript("vite", $fullUrl . "@vite/client", [], null);
                Wordpress::enqueueStyle('main-js', $fullUrl . $this->entryJs, ['jquery'], null, true);
                Wordpress::enqueueStyle('style-css', $fullUrl . $this->entryCss, [], 'null');
            } elseif (Storage::exists($manifestPath)) {
                $manifest = json_decode(Storage::get($manifestPath), true);
                Wordpress::enqueueScript('main-js', Wordpress::getThemeFileUri("public/dist/{$manifest[$this->entryJs]['file']}"), ['jquery'], null, true);
                Wordpress::enqueueStyle('style-css', Wordpress::getThemeFileUri("public/dist/{$manifest[$this->entryCss]['file']}"), [], null);
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