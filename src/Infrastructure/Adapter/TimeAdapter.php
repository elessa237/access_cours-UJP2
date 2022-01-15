<?php

namespace App\Infrastructure\Adapter;

/**
 * Class TimeAdapter
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter
 */
class TimeAdapter
{
    /**
     * Génère une durée au format "30 min".
     * @param int $duration
     * @return string
     */
    public static function duration(int $duration): string
    {
        $minutes = round($duration / 60);
        if ($minutes < 60) {
            return $minutes.' min';
        }
        $hours = floor($minutes / 60);
        $minutes = str_pad((string) ($minutes - ($hours * 60)), 2, '0', STR_PAD_LEFT);

        return "{$hours}h{$minutes}";
    }
}
