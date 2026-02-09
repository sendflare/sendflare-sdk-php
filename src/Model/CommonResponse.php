<?php

namespace Sendflare\SDK\Model;

/**
 * Common response entity
 */
class CommonResponse
{
    public string $requestId;
    public int $code;
    public bool $success;
    public string $message;
    public int $ts;
    /** @var T */
    public mixed $data = null;
}

