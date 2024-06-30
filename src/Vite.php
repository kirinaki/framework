<?php

namespace Kirinaki\Framework;

use Kirinaki\Framework\Contracts\Registrable;

class Vite implements Registrable
{
    private string $manifest;
    private string $host;
    private string $port;
    private string $entry_js;
    private string $entry_css;

    public static function start(
        string $manifest = "public/dist/manifest.json",
        string $host = "http://localhost",
        string $port = "5173",
        string $entry_js = "resources/js/main.js",
        string $entry_css = "resources/css/main.css"
    ): void {
        (new self($manifest, $host, $port, $entry_js, $entry_css))->register();
    }

    public function __construct(string $manifest, string $host, string $port, string $entry_js, string $entry_css)
    {
        $this->manifest = $manifest;
        $this->host = $host;
        $this->port = $port;
        $this->entry_js = $entry_js;
        $this->entry_css = $entry_css;
    }

    private function getFullUrl(): string
    {
        return "{$this->host}:{$this->port}/";
    }

    public function register(): void
    {
        add_action('wp_enqueue_scripts', function () {
            $manifestPath = get_theme_file_path($this->manifest);

            if (is_array(wp_remote_get($this->getFullUrl()))) {

                wp_enqueue_script('vite', $this->getFullUrl() . '@vite/client', [], null);
                wp_enqueue_script('main-js', $this->getFullUrl() . $this->entry_js, ['jquery'], null, true);
                wp_enqueue_style('style-css', $this->getFullUrl() . $this->entry_css, [], 'null');

            } elseif (file_exists($manifestPath)) {

                $manifest = json_decode(file_get_contents($manifestPath), true);
                wp_enqueue_script('main-js', get_theme_file_uri('public/dist/' . $manifest[$this->entry_js]['file']), ['jquery'], null, true);
                wp_enqueue_style('style-css', get_theme_file_uri('public/dist/' . $manifest[$this->entry_css]['file']), [], null);

            }
        });

        add_filter('script_loader_tag', function (string $tag, string $handle, string $src) {
            if (in_array($handle, ['vite', 'main-js'])) {
                return '<script type="module" src="' . esc_url($src) . '" defer></script>';
            }

            return $tag;
        }, 10, 3);
    }
}
