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

Add `TRACKING_MORE_API_KEY` and `TRACKING_MORE_BASE_URL` in your .env file.

You can find the API endpoint (base url) [here](https://www.trackingmore.com/docs/trackingmore/) and get API key [here](https://admin.trackingmore.com/developer/apikey)

## Usage

Inject the Tracking or Courier where you need:

```php

use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Anvari182\TrackingMore\TrackingMoreRequests\Courier;

public function __construct(private Tracking $tracking, private Courier $courier)
{
}

public function index()
{
   // Create a tracking
   $this->tracking->createTracking(TrackingData::from(['trackingNumber' => 'xyz1234']));
   
   // Get all couriers
   $couriers = $this->courier->getAllCourier();
}
```

Or use it with Facade:

```php
use Anvari182\TrackingMore\Facades\TrackingMore;

// Create a tracking
TrackingMore::tracking()->createTracking(TrackingData::from(['trackingNumber' => 'xyz1234']))

 // Get all couriers
$couriers = TrackingMore::courier()->getAllCourier();
```
