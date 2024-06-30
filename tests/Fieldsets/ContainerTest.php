<?php

use Kirinaki\Framework\Fieldsets\Container;

it('should return a valid container using a template', function () {
    Container::template("test", "Test");
})->throws(Error::class);


it('should return a valid container using a post type', function () {
    Container::postType("test", "Test");
})->throws(Error::class);