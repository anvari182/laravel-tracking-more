<?php

namespace Anvari182\TrackingMore\Exceptions;

class MissingArgumentException extends \Exception
{
    public function __construct(string $message = "", int $code = 400)
    {
        parent::__construct($message, $code);
    }
}
