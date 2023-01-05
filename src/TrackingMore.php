<?php

namespace Anvari182\TrackingMore;

use Anvari182\TrackingMore\Concerns\ProcessResponse;
use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Exceptions\EmptyResponseException;
use Anvari182\TrackingMore\Exceptions\MissingArgumentException;
use Cerbero\LaravelDto\Dto;
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
     * Create a tracking.
     *
     * @param  TrackingData  $data
     * @return array
     *
     * @throws EmptyResponseException
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
     * Create multiple trackings (Max. 40 tracking numbers create in one call).
     *
     * @param  array<int, TrackingData|Dto>  $trackingData
     * @return array
     *
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function createMultipleTracking(array $trackingData): array
    {
        if (count($trackingData) > 40) {
            throw new Exception('Max 40 tracking numbers are allowed!');
        }

        $data = [];

        foreach ($trackingData as $tracking) {
            $data[] = $tracking->toArray();
        }

        $response = $this->client->post(self::TRACKING_PATH.'/batch', $data);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * Get tracking results of multiple trackings.
     *
     * @throws Exception
     */
    public function getTrackingResults(): array
    {
        $response = $this->client->get(self::TRACKING_PATH.'/get');

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * Update a tracking by ID.
     *
     * @param  string  $id
     * @return array
     *
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function updateTrackingById(string $id): array
    {
        $response = $this->client->put(self::TRACKING_PATH.'/update/'.$id);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * Delete a tracking by ID.
     *
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function deleteTrackingById(string $id): array
    {
        $response = $this->client->delete(self::TRACKING_PATH.'/delete/'.$id);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * Retrack expired tracking by ID.
     *
     * @param  string  $id
     * @return array
     *
     * @throws EmptyResponseException
     */
    public function retrackExpiredTracking(string $id): array
    {
        $response = $this->client->post(self::TRACKING_PATH.'/retrack/'.$id);

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $this->processMeta($response);

        return $this->getResponseData($response);
    }

    /**
     * Return a list of all supported couriers.
     *
     * @return array
     *
     * @throws EmptyResponseException
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
     * Return a list of matched couriers based on submitted tracking number.
     *
     * @param  string  $trackingNumber
     * @return array
     *
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
