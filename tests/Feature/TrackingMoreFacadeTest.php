<?php

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Facades\TrackingMore;

it('returns Tracking_number is required error', function () {
    TrackingMore::createTracking(TrackingData::from(['trackingNumber' => '']));
})->expectExceptionMessage('Tracking_number is required.');
