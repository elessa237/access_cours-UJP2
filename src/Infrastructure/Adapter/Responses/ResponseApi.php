<?php


namespace App\Infrastructure\Adapter\Responses;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter\Responses
 */
class ResponseApi
{
    public string $message;
    public int $statut;

    public function __construct(string $message, int $statut = 200)
    {
        $this->message = $message;
        $this->statut = $statut;
    }
}