<?php

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Facades\TrackingMore;

it('returns Tracking_number is required error', function () {
    /** @var TrackingData $trackingData */
    $trackingData = TrackingData::from(['trackingNumber' => '']);
    TrackingMore::createTracking($trackingData);
})->expectExceptionMessage('Tracking_number is required.');
