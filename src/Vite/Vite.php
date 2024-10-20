<?php

namespace Kirinaki\Framework\Vite;

use Kirinaki\Framework\Utils\WordpressAdapter;
use Kirinaki\Framework\Vite\Configuration\ViteConfig;

class Vite
{
    private array $register = ["vite"];

    public function __construct(private readonly ViteConfig $config, private readonly WordpressAdapter $wordpress)
    {
    }

    public function handle(array $hooks = []): void
    {
        $action = empty($hooks) ? 'wp_enqueue_scripts' : 'admin_enqueue_scripts';

        $this->wordpress->add_action($action, function ($hook) use ($hooks) {
            if (!empty($hooks) && !in_array($hook, $hooks)) {
                return;
            }
            if ($this->isHotReloadEnabled()) {
                $this->enqueueDevScripts();
            } elseif ($this->isManifestAvailable()) {
                $this->enqueueProductionScripts();
            }
        });
    }

    private function isHotReloadEnabled(): bool
    {
        return file_exists($this->config->getHotPath());
    }

    private function isManifestAvailable(): bool
    {
        return file_exists($this->config->getManifestPath());
    }

    private function enqueueDevScripts(): void
    {
        $this->wordpress->wp_enqueue_script('vite', $this->config->getDevServer() . '/@vite/client', [], null);

        foreach ($this->config->getEntrypoints() as $entrypoint) {
            $id = uniqid();
            $url = $this->config->getDevServer() . '/' . $entrypoint;

            if ($this->isScriptFile($entrypoint)) {
                $this->enqueueScript($id, $url);
            } elseif ($this->isStyleFile($entrypoint)) {
                $this->enqueueStyle($id, $url);
            }
        }

        $this->createFilter();
    }

    private function enqueueProductionScripts(): void
    {
        $manifest = json_decode(file_get_contents($this->config->getManifestPath()), true);

        foreach ($this->config->getEntrypoints() as $entrypoint) {
            $id = uniqid();
            $url = "{$this->config->getOutDirUrl()}/{$manifest[$entrypoint]["file"]}";

            if ($this->isScriptFile($entrypoint)) {
                $this->enqueueScript($id, $url);
            } elseif ($this->isStyleFile($entrypoint)) {
                $this->enqueueStyle($id, $url);
            }
        }

        $this->createFilter();
    }

    private function enqueueScript(string $id, string $url): void
    {
        $this->register[] = $id;
        $this->wordpress->wp_enqueue_script($id, $url, ["jquery"], null, true);
    }

    private function enqueueStyle(string $id, string $url): void
    {
        $this->register[] = $id;
        $this->wordpress->wp_enqueue_style($id, $url, [], null);
    }

    private function createFilter(): void
    {
        $this->wordpress->add_filter('script_loader_tag', function (string $tag, string $handle, string $src) {
            if (in_array($handle, $this->register)) {
                return '<script type="module" src="' . esc_url($src) . '" defer></script>';
            }
            return $tag;
        }, 10, 3);
    }

    private function isScriptFile(string $entrypoint): bool
    {
        return $this->endsWith($entrypoint, [".ts", ".tsx", ".js", ".jsx"]);
    }

    private function isStyleFile(string $entrypoint): bool
    {
        return $this->endsWith($entrypoint, [".css", ".scss", ".sass"]);
    }

    private function endsWith(string $haystack, array $needles): bool
    {
        foreach ($needles as $needle) {
            if (str_ends_with($haystack, $needle)) {
                return true;
            }
        }
        return false;
    }
}
