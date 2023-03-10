<?php

namespace Anvari182\TrackingMore\Exceptions;

use Exception;

class EmptyResponseException extends Exception
{
    public function __construct(
        string $message = 'The Response from trackingMore is empty.',
        int $code = 0
    ) {
        parent::__construct($message, $code);
    }
}
