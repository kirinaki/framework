<?php

namespace Tests\Discovery\Stubs;

use Kirinaki\Framework\Discovery\Attributes\RestController;
use Kirinaki\Framework\Discovery\Attributes\Route;
use Kirinaki\Framework\Discovery\Discoverable;
use Kirinaki\Framework\Discovery\Permissions\CurrentUserCanEditPosts;
use Kirinaki\Framework\Discovery\Permissions\CurrentUserCanManageOptions;

#[RestController(namespace: "/v1")]
class DiscoverableAsRestControllerStub extends Discoverable
{
    #[Route("/test", permissions: [CurrentUserCanEditPosts::class, CurrentUserCanManageOptions::class])]
    public function index()
    {
        return ["hola" => "mundo"];
    }

    #[Route(path: "/test", method: "POST")]
    public function store()
    {
        return ["foo" => "bar"];
    }
}