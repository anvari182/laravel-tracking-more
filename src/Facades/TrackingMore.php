<?php

namespace Anvari182\TrackingMore\Facades;

use Anvari182\TrackingMore\Data\TrackingData;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array createTracking(TrackingData $data)
 * @method static array getAllCourier()
 * @method static array detectCourier(string $trackingNumber)
 */
class TrackingMore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Anvari182\TrackingMore\TrackingMore::class;
    }
}
