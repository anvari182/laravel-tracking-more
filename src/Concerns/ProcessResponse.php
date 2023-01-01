<?php

namespace Anvari182\TrackingMore\Concerns;

trait ProcessResponse
{
    /**
     * @param string|null $code
     * @return bool
     */
    public function isSuccessful(?string $code): bool
    {
        if (is_null($code)) {
            return false;
        }

        if ($code !== '200') {
            return false;
        }

        return true;
    }
}
