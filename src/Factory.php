<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Requests\CourierRequest;
use Anvari182\TrackingMore\Requests\TrackingRequest;
use Illuminate\Http\Client\PendingRequest;

class Factory
{
    /**
     * Create TrackingRequest
     *
     * @return TrackingRequest
     */
    public function getTracking(): TrackingRequest
    {
        return new TrackingRequest(
            new PendingRequest(),
            config('trackingmore.base_url'),
            config('trackingmore.api_key')
        );
    }

    /**
     * Create CourierRequest
     *
     * @return CourierRequest
     */
    public function getCourier(): CourierRequest
    {
        return new CourierRequest(
            new PendingRequest(),
            config('trackingmore.base_url'),
            config('trackingmore.api_key')
        );
    }
}