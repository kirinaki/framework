<?php

namespace Kirinaki\Framework;

use Kirinaki\Framework\Discovery\Discovery;

class ApplicationBuilder
{
    private Application $application;


    public function __construct(Application $application)
    {
        $this->application = $application;
    }


    public function withKernel()
    {
        return $this;
    }

    public function withDiscoverables(array $discoverables): self
    {
        $discovery = $this->application->make(Discovery::class);
        foreach ($discoverables as $class) {
            $discovery->explore(new $class);
        }
        return $this;
    }

    public function create(): Application
    {
        return $this->application;
    }
}