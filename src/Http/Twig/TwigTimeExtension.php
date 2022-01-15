<?php

namespace App\Http\Twig;

use App\Infrastructure\Adapter\TimeAdapter;
use DateTimeInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigTimeExtension extends AbstractExtension
{
    /**
     * @return array<TwigFilter>
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('duration', [$this, 'duration']),
            new TwigFilter('ago', [$this, 'ago'], ['is_safe' => ['html']]),
            new TwigFilter('countdown', [$this, 'countdown'], ['is_safe' => ['html']]),
            new TwigFilter('duration_short', [$this, 'shortDuration'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * Génère une durée au format "30 min".
     * @param int $duration
     * @return string
     */
    public function duration(int $duration): string
    {
        return TimeAdapter::duration($duration);
    }

    /**
     * Génère une durée au format court hh:mm:ss.
     * @param int $duration
     * @return string
     */
    public function shortDuration(int $duration): string
    {
        $minutes = floor($duration / 60);
        $seconds = $duration - $minutes * 60;
        /** @var int[] $times */
        $times = [$minutes, $seconds];
        if ($minutes >= 60) {
            $hours = floor($minutes / 60);
            $minutes = $minutes - ($hours * 60);
            $times = [$hours, $minutes, $seconds];
        }

        return implode(':', array_map(
            fn (int $duration) => str_pad(strval($duration), 2, '0', STR_PAD_LEFT),
            $times
        ));
    }

    /**
     * Génère une date au format "Il y a" grace à un CustomElement.
     * @param DateTimeInterface $date
     * @param string $prefix
     * @return string
     */
    public function ago(DateTimeInterface $date, string $prefix = ''): string
    {
        $prefixAttribute = !empty($prefix) ? " prefix=\"{$prefix}\"" : '';

        return "<time-ago time=\"{$date->getTimestamp()}\"$prefixAttribute></time-ago>";
    }

}
