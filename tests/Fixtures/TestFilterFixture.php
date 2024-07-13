<?php

namespace Tests\Fixtures;

use Kirinaki\Framework\Filters\Filter;

class TestFilterFixture extends Filter
{
    protected string $hook = "the_content";
    public function handle(): void
    {

    }
}
