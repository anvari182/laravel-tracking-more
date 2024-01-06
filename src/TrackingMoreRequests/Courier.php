<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use Exception;
use TrackingMore\Couriers;

class Courier extends Couriers
{
    /**
     * @throws Exception
     */
    public function detectCourier(string $trackingNumber): array
    {
        return $this->detect(['tracking_number' => $trackingNumber]);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->getAllCouriers();
    }
}
