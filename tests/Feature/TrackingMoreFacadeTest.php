<?php

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;

it('returns tracking class', function () {
    expect(TrackingMore::tracking())->toBeInstanceOf(Tracking::class);
});

it('returns courier class', function () {
    expect(TrackingMore::courier())->toBeInstanceOf(Courier::class);
});

it('returns Tracking_number is required error', function () {
    TrackingMore::tracking()->createTracking(TrackingData::from(['trackingNumber' => '']));
})->expectExceptionMessage('Tracking_number is required.');
