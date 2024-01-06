<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use TrackingMore\Couriers;
use TrackingMore\Interfaces\CouriersInterface;
use Trackingmore\TrackingMoreException;

class Courier implements CouriersInterface
{
    public function __construct(private Couriers $couriers)
    {
    }

    public function getAllCouriers(): array
    {
        return $this->couriers->getAllCouriers();
    }

    /**
     * @throws TrackingMoreException
     */
    public function detect($params = []): array
    {
        return $this->couriers->detect($params);
    }
}
