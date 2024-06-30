<?php

namespace Tests\Fixtures;

use Kirinaki\Framework\Controllers\Controller;

class TestControllerPostFixture extends Controller
{
    function route(): \Kirinaki\Framework\Http\Route
    {
        return \Kirinaki\Framework\Http\Route::post("test");
    }

    function handle(\Kirinaki\Framework\Http\Request $request): ?\Kirinaki\Framework\Http\Response
    {
        return new \Kirinaki\Framework\Http\Response(["message" => "ok"]);
    }
}