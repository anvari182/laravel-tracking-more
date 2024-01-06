<?php

namespace Anvari182\TrackingMore\TrackingMoreRequests;

use Anvari182\TrackingMore\Data\TrackingData;
use Anvari182\TrackingMore\Helpers\ArrayHelper;
use Exception;
use TrackingMore\TrackingMoreException;
use TrackingMore\Trackings;

class Tracking extends Trackings
{
    /**
     * @param TrackingData $data
     * @return array
     * @throws TrackingMoreException
     */
    public function create(TrackingData $data): array
    {
        return $this->createTracking(ArrayHelper::camelToSnakeKeys($data->toArray()));
    }

    /**
     * @param array $trackingData
     * @return array
     * @throws TrackingMoreException
     * @throws Exception
     */
    public function createMultiple(array $trackingData): array
    {
        if (count($trackingData) > 40) {
            throw new Exception('Max 40 tracking numbers are allowed!');
        }

        $data = [];

        foreach ($trackingData as $tracking) {
            $data[] = $tracking->toArray();
        }

        return $this->batchCreateTrackings($data);
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->getTrackingResults();
    }

    /**
     * @param string $id
     * @param array $params
     * @return array
     * @throws TrackingMoreException
     */
    public function updateById(string $id, array $params): array
    {
        return $this->updateTrackingByID($id, $params);
    }

    /**
     * @param string $id
     * @return array
     * @throws TrackingMoreException
     */
    public function deleteById(string $id): array
    {
        return $this->deleteTrackingByID($id);
    }

    /**
     * @param string $id
     * @return array
     * @throws TrackingMoreException
     */
    public function retrackByID(string $id): array
    {
        return $this->retrackTrackingByID($id);
    }
}
