<?php

namespace Kirinaki\Framework\Factories;

use Kirinaki\Framework\Attributes\Controller;
use Kirinaki\Framework\Attributes\RestController;
use Kirinaki\Framework\Models\ClassMeta;
use Kirinaki\Framework\Strategies\ControllerStrategy;
use Kirinaki\Framework\Strategies\OnlyMethodsStrategy;
use Kirinaki\Framework\Strategies\RestControllerStrategy;
use Kirinaki\Framework\Strategies\Strategy;


class StrategyFactory
{
    public function generate(ClassMeta $classMeta): Strategy
    {
        if ($classMeta->hasAttribute(RestController::class)) {
            return new RestControllerStrategy();
        }

        if ($classMeta->hasAttribute(Controller::class)) {
            return new ControllerStrategy();
        }

        return new OnlyMethodsStrategy();
    }
}