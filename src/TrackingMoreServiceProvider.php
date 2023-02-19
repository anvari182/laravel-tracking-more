<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\TrackingMoreRequests\Courier;
use Anvari182\TrackingMore\TrackingMoreRequests\Tracking;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;

class TrackingMoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/trackingmore.php', 'trackingmore');

        $httpClient = new HttpClient(
            pendingRequest: new PendingRequest(),
            baseUrl:        config('trackingmore.base_url'),
            apiKey:         config('trackingmore.api_key')
        );

        $this->app->bind(TrackingMore::class, function () use ($httpClient) {
            $tracking = new Tracking(httpClient: $httpClient);
            $courier = new Courier(httpClient: $httpClient);

            return new TrackingMore(tracking: $tracking, courier: $courier);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__.'/../config/trackingmore.php' => config_path('trackingmore.php'),
                ],
                'config'
            );
        }
    }
}
