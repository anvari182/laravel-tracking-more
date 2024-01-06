<?php

namespace Anvari182\TrackingMore\Data;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class TrackingData extends Data
{
    public string|Optional $orderNumber;
    public string|Optional $customerEmail;
    public string|Optional $originCountryIso2;
    public string|Optional $destinationCountryIso2;
    public string|Optional $customerName;
    public string|Optional $customerSms;
    public string|Optional $title;
    public string|Optional $logisticsChannel;
    public string|Optional $orderId;
    public string|Optional $orderDate;
    public string|Optional $trackingCourierAccount;
    public string|Optional $trackingPostalCode;
    public string|Optional $trackingOriginCountry;
    public string|Optional $trackingDestinationCountry;
    public string|Optional $trackingShipDate;
    public string|Optional $trackingKey;
    public string|Optional $language;
    public string|Optional $note;
    public int|Optional $autoCorrect;

    public function __construct(
        public string $trackingNumber,
        public string $courierCode
    ) {
    }
}
