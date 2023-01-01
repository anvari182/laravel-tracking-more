<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Requests\CourierRequest;
use Anvari182\TrackingMore\Requests\TrackingRequest;

class TrackingMore
{
    /**
     * @param Factory $factory
     */
    public function __construct(private Factory $factory)
    {
    }

    /**
     * Get TrackingRequest instance
     *
     * @return TrackingRequest
     */
    public function tracking(): TrackingRequest
    {
        return $this->factory->getTracking();
    }

    /**
     * Get CourierRequest instance
     *
     * @return CourierRequest
     */
    public function couriers(): CourierRequest
    {
        return $this->factory->getCourier();
    }

    /**
     * @return Factory
     */
    public function getFactory(): Factory
    {
        return $this->factory;
    }
}