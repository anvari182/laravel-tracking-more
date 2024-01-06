<?php

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Support\Facades\File;
use TrackingMore\Couriers;
use TrackingMore\Trackings;

it('returns tracking class', function () {
    expect(TrackingMore::tracking())->toBeInstanceOf(Trackings::class);
});

it('returns courier class', function () {
    expect(TrackingMore::courier())->toBeInstanceOf(Couriers::class);
});

it('creates a tracking', function () {
    $tracking = mock(Tracking::class);
    $tracking->shouldReceive('create')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/createTrackingResponse.json'), true));
    TrackingMore::shouldReceive('tracking')->andReturn($tracking);
    $result = TrackingMore::tracking()->create(new TrackingData(trackingNumber: 'xyz123', courierCode: 'ups'));
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    expect($result['data']['tracking_number'])->toBe('XYZ123');
});

it('gets tracking results', function () {
    $tracking = mock(Tracking::class);
    $tracking->shouldReceive('getResults')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/allTrackingResponse.json'), true));
    TrackingMore::shouldReceive('tracking')->andReturn($tracking);
    $result = TrackingMore::tracking()->getResults();
    expect($result)->toBeArray()->not()->toBeEmpty();
    expect($result['meta']['code'])->toBe(200);
    expect($result['data'][0]['tracking_number'])->toBe('XYZ124');
});

it('returns error if required parameter is missing for creating tracking', function (TrackingData $data, string $exceptionMessage) {
    $this->expectExceptionMessage($exceptionMessage);
    TrackingMore::tracking()->create($data);
})->with([
    'Tracking number is empty' => [
        new TrackingData(trackingNumber: '', courierCode: ''),
        'Tracking number cannot be empty'
    ],
    'Courier code is empty' => [
        new TrackingData(trackingNumber: 'xyz123', courierCode: ''),
        'Courier Code cannot be empty'
    ],
]);
