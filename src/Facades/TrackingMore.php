<?php

namespace Anvari182\TrackingMore\Facades;

use Anvari182\TrackingMore\Requests\TrackingRequest;
use Illuminate\Support\Facades\Facade;

/**
 * @method static TrackingRequest tracking()
 */
class TrackingMore extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'TrackingMore';
    }
}