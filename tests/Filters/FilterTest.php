<?php

it('should run the hook correctly', function () {
    \Brain\Monkey\Functions\expect("add_filter");

    $filterA = new \Tests\Fixtures\TestFilterFixture();
    $filterA->register();
});
