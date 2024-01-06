# Laravel TrackingMore

A Laravel package for managing [TrackingMore API](https://www.trackingmore.com/docs/trackingmore/).

TrackingMore helps eCommerce businesses to update and manage their shipment with efficiency.

## Version support

- **PHP**: 8.0
- **Laravel**: 9.0, 10.0

## Installation

You can install using [composer](https://getcomposer.org/)
from [Packagist](https://packagist.org/packages/anvari182/laravel-tracking-more).

```
$ composer require anvari182/laravel-tracking-more
```

Add `TRACKING_MORE_API_KEY` in your .env file.

You can get API key [here](https://admin.trackingmore.com/developer/apikey)

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
   $this->tracking->create(new TrackingData(trackingNumber: 'xyz123', courierCode: 'ups'));
   
   // Get all couriers
   $couriers = $this->courier->getAllCourier();
}
```

Or use it with Facade:

```php
use Anvari182\TrackingMore\Facades\TrackingMore;

// Create a tracking
TrackingMore::tracking()->create(new TrackingData(trackingNumber: 'xyz123', courierCode: 'ups'))

 // Get all couriers
$couriers = TrackingMore::courier()->getAllCourier();
```

## Tracking
##### Create a tracking
```php
TrackingMore::tracking()->create(new TrackingData(trackingNumber: 'xyz123', courierCode: 'ups'))
```

##### Get results
```php
TrackingMore::tracking()->getResults()
```

##### Create trackings
Create multiple trackings (Max. 40 tracking numbers create in one call).
```php
 TrackingMore::tracking()->createMultiple([
        ['tracking_number' => 'xyz1234', 'courier_code' => 'ups'],
        ['tracking_number' => 'xyz1235', 'courier_code' => 'ups'],
        ['tracking_number' => 'xyz1236', 'courier_code' => 'ups'],
    ]);
```

##### Update a tracking by ID
Tracking ID
```php
TrackingMore::tracking()->updateById('13123213213213', ['note' => 'New test order note', 'customer_name'=>'New name'])
```

##### Delete a tracking by ID
Tracking ID
```php
TrackingMore::tracking()->deleteById('13123213213213')
```

##### Retrack an expired tracking by ID
Tracking ID
```php
TrackingMore::tracking()->retrackByID('13123213213213')
```

## Courier

##### Detect courier
Return a list of matched couriers based on submitted tracking number.
```php
TrackingMore::courier()->detectCourier(['tracking_number' => '9261290312833844954982'])
```

##### Get all couriers
Return a list of all supported couriers.
```php
TrackingMore::courier()->getAll()
```