<?php

namespace Anvari182\TrackingMore\Helpers;

use Illuminate\Support\Str;

class ArrayHelper
{
    /**
     * @param array $inputArray
     * @return array
     */
    public static function camelToSnakeKeys(array $inputArray): array
    {
        $outputArray = [];

        foreach ($inputArray as $key => $value) {
            $underscoreKey = Str::snake($key);
            $outputArray[$underscoreKey] = is_array($value) ? self::camelToSnakeKeys($value) : $value;
        }

        return $outputArray;
    }
}
