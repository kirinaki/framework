<?php

uses()->beforeEach(function () {
    $this->request = new \Kirinaki\Framework\Http\Request("POST", ["name" => "test"]);
});

it('should return the method attribute', function () {
    $result = $this->request->method();
    expect($result)->toBe("POST");
});

it('should return true in IsPost()', function () {
    $result = $this->request->isPost();
    expect($result)->toBe(true);
});

it('should return false in IsGet()', function () {
    $result = $this->request->isGet();
    expect($result)->toBe(false);
});

it('should return the data', function () {
    $result = $this->request->data();
    expect($result)->toBeArray();
});

it('should return the input', function () {
    $result = $this->request->input("name");
    expect($result)->toBe("test");
});