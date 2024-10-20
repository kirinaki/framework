<?php

namespace Kirinaki\Framework\Discovery;

use Kirinaki\Framework\Application\Application;

abstract class Discoverable
{
    public function __construct(protected Application $app)
    {
    }
}