<?php


namespace App\Infrastructure\Adapter\Validator;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter\Validator
 */
Abstract class CheckParameter
{
    static function check(array $data, array $required): array
    {
        $missingData = [];
        foreach ($required as $item) {
            if (!array_key_exists($item, $data)) {
                $missingData[] = $item;
            }
        }

        return [
            'missing' => $missingData,
            'count' => count($missingData),
        ];
    }
}