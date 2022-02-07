<?php


namespace App\Infrastructure\Adapter\Validator;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter\Validator
 */
final class CheckParameter
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

    static function equalPassword(string $param1, $param2): bool
    {
       return $param1 === $param2;
    }

}