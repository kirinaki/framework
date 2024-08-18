<?php

namespace Kirinaki\Framework\Discovery;

use Kirinaki\Framework\Contracts\Discoverable;
use Kirinaki\Framework\Models\ClassMeta;
use Kirinaki\Framework\Models\MethodMeta;
use ReflectionClass;

class ClassDiscovery
{
    public function explore(Discoverable $class): ClassMeta
    {
        $reflection = new ReflectionClass($class);
        $classMeta = new ClassMeta();
        $classMeta->setClassName($reflection->getName());
        $classMeta->setName($reflection->getShortName());

        foreach ($reflection->getAttributes() as $attribute) {
            $classMeta->addAttribute($attribute->getName(), $attribute->newInstance());
        }

        foreach ($reflection->getMethods() as $method) {
            $methodMeta = new MethodMeta();
            $methodMeta->setName($method->getShortName());

            foreach ($method->getAttributes() as $attribute) {
                $methodMeta->addAttribute($attribute->getName(), $attribute->newInstance());
            }
            $classMeta->addMethod($method->getName(), $methodMeta);
        }

        return $classMeta;
    }

}