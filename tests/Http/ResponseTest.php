<?php

it('should render the content', function () {
    $response = new \Kirinaki\Framework\Http\Response("OK", 200);
    $response->render();
    expect($response)->toBeInstanceOf(\Kirinaki\Framework\Http\Response::class);
});

it('should render nothing', function () {
    $response = new \Kirinaki\Framework\Http\Response(null);
    $response->render();
    expect($response)->toBeInstanceOf(\Kirinaki\Framework\Http\Response::class);
});

