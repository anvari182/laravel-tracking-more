<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use Anvari182\TrackingMore\Concerns\ProcessResponse;
use Anvari182\TrackingMore\HttpClient;
use Exception;
use Illuminate\Http\Client\Response;

class Courier
{
    use ProcessResponse;

    protected const COURIER_PATH = 'couriers';

    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @throws Exception
     */
    public function detectCourier(string $trackingNumber): array
    {
        /** @var Response $response */
        $response = $this->httpClient->request()->post(
            self::COURIER_PATH.'/detect',
            ['tracking_number' => $trackingNumber]
        );

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        return $this->getResponseData($response);
    }

    /**
     * @throws Exception
     */
    public function getAllCourier(): array
    {
        /** @var Response $response */
        $response = $this->httpClient->request()->get(self::COURIER_PATH.'/all');

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response, 'couriers');
    }
}
