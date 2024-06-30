<?php

use Kirinaki\Framework\Wordpress\Walkers\HierarchicalWalker;

it('should return an array', function () {
    $walker = new HierarchicalWalker();
    $elements = [
      [
          'parent' => '1',  'db_id' => "2"
      ]
    ];
    $walker->walk([$elements], -1);

    expect($walker->toArray())->toBeArray();
});
