<?php

namespace Kirinaki\Framework\Application\Configuration;

class ApplicationConfig
{
    public function __construct(
        private string $basePath,
        private string $filePath,
    )
    {
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }
}