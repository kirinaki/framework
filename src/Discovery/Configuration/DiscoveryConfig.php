<?php

namespace Kirinaki\Framework\Discovery\Configuration;

class DiscoveryConfig
{
    public function __construct(protected array $discoverables, protected array $handlers = [])
    {
    }

    public function getDiscoverables(): array
    {
        return $this->discoverables;
    }

    public function getHandlers(): array
    {
        return $this->handlers;
    }
}