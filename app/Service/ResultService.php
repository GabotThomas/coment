<?php

namespace App\Service;

class ResultService
{
    const RESULTS = [
        '1' => [-0.1, 33],
        '2' => [33, 75],
        '3' => [75, 100],
    ];

    public static function getResult($pourcentage)
    {
        foreach (self::RESULTS as $key => $result) {
            if ($pourcentage > $result[0] && $pourcentage <= $result[1]) {
                return $key;
            }
        }
        return 0;
    }
}
