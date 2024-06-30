<?php

namespace Kirinaki\Framework\Http;

class Response
{
    private $content;
    private int $status;

    public function __construct($content, int $status = 200)
    {
        $this->content = $content;
        $this->status = $status;
    }

    public function render(): void
    {
        if (!$this->content) {
            return;
        }

        http_response_code($this->status);
        echo $this->content;
    }
}
