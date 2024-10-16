<?php

namespace Kirinaki\Framework\View\Engines;

interface Engine
{
    public function registerFunction($function);

    public function render(string $file, array $data = []);
}