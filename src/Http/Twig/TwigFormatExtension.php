<?php


namespace App\Http\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Twig
 */
class TwigFormatExtension extends AbstractExtension
{
    /**
     * @return array<TwigFilter>
     */
    public function getFilters(): array
    {
        return [
            new TwigFilter('data', [$this, 'data']),
        ];
    }

    public function data(int $data) : string
    {
        return round(($data * 0.000000953674316),2);
    }
}