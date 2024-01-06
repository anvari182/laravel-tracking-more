<?php

namespace Anvari182\TrackingMore;

use TrackingMore\Couriers as Courier;
use TrackingMore\Trackings as Tracking;

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

    /**
     * @return Tracking
     */
    public function tracking(): Tracking
    {
        return $this->tracking;
    }
}
