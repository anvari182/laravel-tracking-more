<?php

namespace Anvari182\TrackingMore\Facades;

use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Courier courier()
 * @method static Tracking tracking()
 */
class TrackingMore extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Anvari182\TrackingMore\TrackingMore::class;
    }
}
