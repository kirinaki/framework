<?php

namespace Tests\Discovery\Stubs;

use Kirinaki\Framework\Discovery\Attributes\Action;
use Kirinaki\Framework\Discovery\Discoverable;


class DiscoverableAsActionStub extends Discoverable
{
    #[Action("init")]
    public function index()
    {
        return ["hola" => "mundo"];
    }
}