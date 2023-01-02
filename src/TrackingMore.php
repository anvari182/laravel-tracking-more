<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Concerns\ProcessResponse;
use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Exceptions\EmptyResponseException;
use Anvari182\TrackingMore\Exceptions\MissingArgumentException;
use Exception;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

class TrackingMore
{
    use ProcessResponse;

    protected const COURIER_PATH = 'couriers';

    protected const TRACKING_PATH = 'trackings';

    /**
     * @throws MissingArgumentException
     */
    public function __construct(
        protected PendingRequest $client,
        protected string $baseUrl,
        protected string $apiKey
    ) {
        if (empty($this->baseUrl)) {
            throw new MissingArgumentException('Base URL is missing.');
        }

        if (empty($this->apiKey)) {
            throw new MissingArgumentException('API key is missing.');
        }

        $this->client->baseUrl($this->baseUrl);

        $this->client->withHeaders(['Tracking-Api-Key' => $this->apiKey]);
    }

    /**
     * @throws Exception
     */
    public function createTracking(TrackingData $data): array
    {
        /** @var Response $response */
        $response = $this->client->post(self::TRACKING_PATH.'/create', $data->toArray());

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * @throws Exception
     */
    public function getAllCourier(): array
    {
        /** @var Response $response */
        $response = $this->client->get(self::COURIER_PATH.'/all');

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response, 'couriers');
    }

    /**
     * @throws Exception
     */
    public function detectCourier(string $trackingNumber): array
    {
        /** @var Response $response */
        $response = $this->client->post(self::COURIER_PATH.'/detect', ['tracking_number' => $trackingNumber]);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        return $this->getResponseData($response);
    }

    /**
     * @param  Response  $response
     * @return void
     *
     * @throws EmptyResponseException
     * @throws Exception
     */
    protected function processMeta(Response $response): void
    {
        $meta = $response->collect('meta');

        if ($meta->isEmpty()) {
            throw new EmptyResponseException();
        }

        if (! $this->isSuccessful($meta->get('code'))) {
            throw new Exception($meta['message'] ?? 'TrackingMore request failed.');
        }
    }

    /**
     * @param  Response  $response
     * @param  string  $key
     * @return array
     */
    protected function getResponseData(Response $response, string $key = 'data'): array
    {
        $data = $response->collect($key);

        if ($data->isEmpty()) {
            return [];
        }

        return $data->toArray();
    }
}
