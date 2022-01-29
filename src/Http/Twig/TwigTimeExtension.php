<?php

namespace App\Http\Twig;

use DateTimeImmutable;
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
            new TwigFilter('ago', [$this, 'ago'], ['is_safe' => ['html']])
        ];
    }

    /**
     * Génère une date au format "Il y a" grace à un CustomElement.
     * @param DateTimeImmutable $date
     * @param string $prefix
     * @return string
     */
    public function ago(DateTimeImmutable $date, string $prefix = ''): string
    {
        $prefixAttribute = !empty($prefix) ? "prefix=\"{$prefix}\"" : '';

        return "<time-ago time=\"{$date->getTimestamp()}\" $prefixAttribute></time-ago>";
    }

}
