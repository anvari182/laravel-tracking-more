<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;

class TrackingMore
{
    public function __construct(protected Tracking $tracking, protected Courier $courier)
    {
    }

    /**
     * @return Courier
     */
    public function courier(): Courier
    {
        return $this->courier;
    }

    public function tracking(): Tracking
    {
        return $this->tracking;
    }
}
