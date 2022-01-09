<?php


namespace App\Infrastructure\Adapter;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter
 */
class AbstractCase
{
    /**
     * @param string $message
     * @param null $data
     * @return ResponseCase
     */
    public function successResponse(string $message, $data = null) : ResponseCase
    {
        return new ResponseCase("success" ,$message, $data);
    }

    /**
     * @param string $message
     * @param null $data
     * @return ResponseCase
     */
    public function errorResponse(string $message, $data = null): ResponseCase
    {
        return new ResponseCase("error" ,$message, $data);
    }
}