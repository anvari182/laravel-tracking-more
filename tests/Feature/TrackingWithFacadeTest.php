<?php

use Anvari182\TrackingMore\Facades\TrackingMore;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Support\Facades\File;

it('returns tracking class', function () {
    expect(TrackingMore::tracking())->toBeInstanceOf(Tracking::class);
});

it('returns courier class', function () {
    expect(TrackingMore::courier())->toBeInstanceOf(Courier::class);
});

it('creates a tracking', function () {
    $tracking = mock(Tracking::class);
    $tracking->shouldReceive('createTracking')->andReturn(json_decode(File::get(__DIR__ . '/../Fixtures/createTrackingResponse.json'), true));
    TrackingMore::shouldReceive('tracking')->andReturn($tracking);
    $result = TrackingMore::tracking()->createTracking(['tracking_number' => 'xyz123', 'courier_code' => 'ups']);
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

it('returns error if required parameter is missing for creating tracking', function (array $data, string $exceptionMessage) {
    $this->expectExceptionMessage($exceptionMessage);
    TrackingMore::tracking()->createTracking($data);
})->with([
    'Tracking number is empty' => [
        ['tracking_number' => '', 'courier_code' => ''],
        'Tracking number cannot be empty'
    ],
    'Courier code is empty' => [
        ['tracking_number' => 'xyz123', 'courier_code' => ''],
        'Courier Code cannot be empty'
    ],
]);
