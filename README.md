# Laravel TrackingMore

A Laravel package for managing [TrackingMore API](https://www.trackingmore.com/docs/trackingmore/).

TrackingMore helps eCommerce businesses to update and manage their shipment with efficiency.

This package is a wrapper of [TrackingMore API PHP SDK](https://github.com/TrackingMore-API/trackingmore-sdk-php) for Laravel.

## Version support

- **PHP**: 8.0 | 8.1 | 8.2
- **Laravel**: 10.0

## Installation

You can install using [composer](https://getcomposer.org/)
from [Packagist](https://packagist.org/packages/anvari182/laravel-tracking-more).

```
$ composer require anvari182/laravel-tracking-more
```

## Configuration

Add `TRACKING_MORE_API_KEY` in your .env file.

Get your TrackingMore API key from [TrackingMore](https://admin.trackingmore.com/developer/apikey)

```php
php artisan vendor:publish --provider="Anvari182\TrackingMore\TrackingMoreServiceProvider" --tag="config"
```

## Usage

Inject the Tracking or Courier where you need:

```php

use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\Data\TrackingData;

public function __construct(private Tracking $tracking, private Courier $courier)
{
}

public function index()
{
   // Create a tracking
   $this->tracking->createTracking(['tracking_number' => 'xyz123', 'courier_code' => 'ups']);
   
   // Get all couriers
   $couriers = $this->courier->getAllCouriers();
}
```

Or use it with Facade:

```php
use Anvari182\TrackingMore\Facades\TrackingMore;

// Create a tracking
TrackingMore::tracking()->createTracking(['tracking_number' => 'xyz123', 'courier_code' => 'ups'])

 // Get all couriers
$couriers = TrackingMore::courier()->getAllCouriers();
```

## Tracking
##### Create a tracking
```php
TrackingMore::tracking()->createTracking(['tracking_number' => 'xyz123', 'courier_code' => 'ups'])
```

##### Get results
```php
TrackingMore::tracking()->getTrackingResults()
```

##### Create trackings
Create multiple trackings (Max. 40 tracking numbers create in one call).
```php
 TrackingMore::tracking()->batchCreateTrackings([
        ['tracking_number' => 'xyz1234', 'courier_code' => 'ups'],
        ['tracking_number' => 'xyz1235', 'courier_code' => 'ups'],
        ['tracking_number' => 'xyz1236', 'courier_code' => 'ups'],
    ]);
```

##### Update a tracking by ID
Tracking ID
```php
TrackingMore::tracking()->updateTrackingByID('13123213213213', ['note' => 'New test order note', 'customer_name'=>'New name'])
```

##### Delete a tracking by ID
Tracking ID
```php
TrackingMore::tracking()->deleteTrackingByID('13123213213213')
```

##### Retrack an expired tracking by ID
Tracking ID
```php
TrackingMore::tracking()->retrackTrackingByID('13123213213213')
```

## Courier

##### Detect courier
Return a list of matched couriers based on submitted tracking number.
```php
TrackingMore::courier()->detect(['tracking_number' => '9261290312833844954982'])
```

##### Get all couriers
Return a list of all supported couriers.
```php
TrackingMore::courier()->getAllCouriers()
```

## Dependencies
[TrackingMore API PHP SDK](https://github.com/TrackingMore-API/trackingmore-sdk-php) v.1.0.0

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
This project is licensed under the MIT License - see the [LICENSE](https://github.com/anvari182/laravel-tracking-more/blob/feature/use-trackingmore-sdk/LICENSE) file for details.