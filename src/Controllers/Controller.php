<?php

namespace Kirinaki\Framework\Controllers;

use Kirinaki\Framework\Contracts\Registrable;
use Kirinaki\Framework\Http\Request;
use Kirinaki\Framework\Http\Response;
use Kirinaki\Framework\Http\Route;

abstract class Controller implements Registrable
{
    abstract public function route(): Route;

    abstract public function handle(Request $request): ?Response;

    public function register(): void
    {
        add_action('admin_post_' . $this->route()->event(), [$this, "prepare"]);
        add_action('admin_post_nopriv_' . $this->route()->event(), [$this, "prepare"]);
    }

    public function prepare(): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $data = match ($method) {
            "POST" => $_POST,
            "GET" => $_GET
        };

        $request = new Request(
            method: $method,
            data: $data
        );

        if ($request->method() == $this->route()->method()) {
            $response = $this->handle($request);
            $response?->render();
        }

    }
}
