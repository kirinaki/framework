<?php


it("should get an instance", function () {
    $app = new \DI\Container(["foo" => "bar"]);
    \Kirinaki\Framework\Facades\App::setFacadeApplication($app);
    $result = \Kirinaki\Framework\Facades\App::make("foo");

    expect($result)->toBe("bar");
});

