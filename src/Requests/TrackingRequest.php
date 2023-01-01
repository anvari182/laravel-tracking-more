<?php

namespace Anvari182\TrackingMore\Requests;

use Anvari182\TrackingMore\Concerns\CheckResponseCode;
use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Exceptions\EmptyResponseException;
use Exception;

class TrackingRequest extends BaseRequest
{
    use CheckResponseCode;

    private const BASE_PATH = 'trackings';

    private const CREATE = 'create';

    /**
     * @throws Exception
     */
    public function createTracking(TrackingData $data): array
    {
        $response = $this->client->post(self::BASE_PATH . '/' . self::CREATE, $data->toArray());

        if ($response->failed()) {
            throw new Exception($response->toException()->getMessage());
        }

        $meta = $response->collect('meta');

        if ($meta->isEmpty()) {
            throw new EmptyResponseException;
        }

        if (!$this->isSuccessful($meta->toArray())) {
            throw new Exception($meta['message'] ?? 'Create ');
        }

        return $response->collect('data')->toArray();
    }
}