<?php

namespace Anvari182\TrackingMore\Concerns;

trait CheckResponseCode
{
    public function isSuccessful(array $meta): bool
    {
        if ($meta['code'] === '200') {
            return true;
        }

        return false;
    }
}