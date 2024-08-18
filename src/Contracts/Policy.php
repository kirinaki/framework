<?php

namespace Kirinaki\Framework\Contracts;

interface Policy
{
    public function evaluate(): bool;
}