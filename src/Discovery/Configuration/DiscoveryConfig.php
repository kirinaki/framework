<?php

namespace Kirinaki\Framework\Discovery\Configuration;

class DiscoveryConfig
{
    public function __construct(protected array $discoverables)
    {
    }

    public function getDiscoverables(): array
    {
        return $this->discoverables;
    }
}