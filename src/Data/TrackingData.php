<?php

namespace Anvari182\TrackingMore\Data;

use const Cerbero\Dto\IGNORE_UNKNOWN_PROPERTIES;
use const Cerbero\Dto\PARTIAL;
use Cerbero\LaravelDto\Dto;

/**
 * @property string $trackingNumber
 * @property string $courierCode
 * @property string $orderNumber
 * @property string $customerEmail
 * @property string $originCountryIso2
 * @property string $destinationCountryIso2
 * @property string $customerName
 * @property string $customerSms
 * @property string $title
 * @property string $logisticsChannel
 * @property string $orderId
 * @property string $orderDate
 * @property string $trackingCourierAccount
 * @property string $trackingPostalCode
 * @property string $trackingOriginCountry
 * @property string $trackingDestinationCountry
 * @property string $trackingShipDate
 * @property string $trackingKey
 * @property string $language
 * @property string $note
 * @property int $autoCorrect = 0
 */
class TrackingData extends Dto
{
    protected static $defaultFlags = PARTIAL | IGNORE_UNKNOWN_PROPERTIES;
}
