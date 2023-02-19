<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use Anvari182\TrackingMore\Concerns\ProcessResponse;
use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Exceptions\EmptyResponseException;
use Anvari182\TrackingMore\HttpClient;
use Cerbero\LaravelDto\Dto;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;

class Tracking
{
    use ProcessResponse;

    protected const TRACKING_PATH = 'trackings';

    public function __construct(private HttpClient $httpClient)
    {
    }

    /**
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function createTracking(TrackingData|Dto $data): array
    {
        /** @var Response $response */
        $response = $this->httpClient->request()->post(self::TRACKING_PATH.'/create', $data->toArray());

        return $this->processResponse($response);
    }

    /**
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

        $response = $this->httpClient->request()->post(self::TRACKING_PATH.'/batch', $data);

        return $this->processResponse($response);
    }

    /**
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function getTrackingResults(): array
    {
        $response = $this->httpClient->request()->get(self::TRACKING_PATH.'/get');

        return $this->processResponse($response);
    }

    /**
     * @throws EmptyResponseException
     * @throws Exception
     */
    public function updateTrackingById(string $id): array
    {
        $response = $this->httpClient->request()->put(self::TRACKING_PATH.'/update/'.$id);

        return $this->processResponse($response);
    }

    /**
     * @throws EmptyResponseException|RequestException
     */
    public function deleteTrackingById(string $id): array
    {
        $response = $this->httpClient->request()->delete(self::TRACKING_PATH.'/delete/'.$id);

        return $this->processResponse($response);
    }

    /**
     * @throws RequestException
     * @throws EmptyResponseException
     */
    public function reTrackExpiredTracking(string $id): array
    {
        $response = $this->httpClient->request()->post(self::TRACKING_PATH.'/retrack/'.$id);

        return $this->processResponse($response);
    }
}
