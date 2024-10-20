<?php

namespace Kirinaki\Framework\Discovery\Attributes;


use Kirinaki\Framework\Support\Contracts\Arrayable;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Action implements Arrayable
{
    private string $hook;
    private int $priority;
    private int $acceptedArgs;

    public function __construct(string $hook, int $priority = 10, int $acceptedArgs = 1)
    {
        $this->hook = $hook;
        $this->priority = $priority;
        $this->acceptedArgs = $acceptedArgs;
    }

    public function getHook(): string
    {
        return $this->hook;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function getAcceptedArgs(): int
    {
        return $this->acceptedArgs;
    }

    public function toArray(): array
    {
        return [
            'hook' => $this->hook,
            'priority' => $this->priority,
            'acceptedArgs' => $this->acceptedArgs,
        ];
    }
}