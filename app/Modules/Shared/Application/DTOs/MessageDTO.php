<?php

namespace Modules\Shared\Application\DTOs;

class MessageDTO
{
    public bool $success;
    public string $message;
    public int $code;
    public mixed $payload;

    public function __construct(bool $success, string $message, int $code, mixed $payload)
    {
        $this->success = $success;
        $this->message = $message;
        $this->code = $code;
        $this->payload = $payload;
    }
}
