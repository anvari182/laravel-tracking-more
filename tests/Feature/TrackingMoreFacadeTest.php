<?php

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\Requests\TrackingRequest;

use function PHPUnit\Framework\assertInstanceOf;

it('returns Tracking_number is required error', function () {
    $tracking = TrackingMore::tracking();
    assertInstanceOf(TrackingRequest::class, $tracking);

    $trackingData = new TrackingData();
    $tracking->createTracking($trackingData);
})->expectExceptionMessage('Tracking_number is required.');