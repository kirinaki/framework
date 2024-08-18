<?php

namespace Kirinaki\Framework\Attributes;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Policies
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }


    public function evaluate(): bool
    {
        foreach ($this->rules as $rule) {
            if (!(new $rule())->evaluate()) {
                return false;
            }
        }

        return true;
    }
}