<?php

namespace Anvari182\TrackingMore\Data;

use Cerbero\LaravelDto\Dto;

use const Cerbero\Dto\IGNORE_UNKNOWN_PROPERTIES;
use const Cerbero\Dto\PARTIAL;

/**
 * @property string $trackingNumber
 * @property string $courierCode
 * @property string $orderNumber
 * @property string $customerEmail
 */
class TrackingData extends Dto
{
    protected static $defaultFlags = PARTIAL | IGNORE_UNKNOWN_PROPERTIES;
}