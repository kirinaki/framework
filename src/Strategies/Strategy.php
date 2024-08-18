<?php

namespace Kirinaki\Framework\Strategies;

use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Models\ClassMeta;

interface Strategy
{
    public function run(ClassMeta $classMeta, Discoverable $controller);
}