<?php

namespace Kirinaki\Framework\Vite\Configuration;

class ViteConfig
{
    public function __construct(
        private string $publicPath,
        private array  $entrypoints,
        private string $url,
        private string $outDir = "dist",
        private string $manifestFilename = "manifest.json",
        private string $hotFile = "hot",
        private string $devServer = "http://localhost:5173",
    )
    {
    }

    public function getManifestPath(): string
    {
        return $this->publicPath . "/" . $this->outDir . "/" . $this->manifestFilename;
    }

    public function getOutDirUrl(): string
    {
        return $this->url . "/" . $this->outDir;
    }

    public function getHotPath(): string
    {
        return $this->publicPath . "/" . $this->hotFile;
    }

    public function getPublicPath(): string
    {
        return $this->publicPath;
    }

    public function getEntrypoints(): array
    {
        return $this->entrypoints;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getOutDir(): string
    {
        return $this->outDir;
    }

    public function getManifestFilename(): string
    {
        return $this->manifestFilename;
    }

    public function getHotFile(): string
    {
        return $this->hotFile;
    }

    public function getDevServer(): string
    {
        return $this->devServer;
    }
}