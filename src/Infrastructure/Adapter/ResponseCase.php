<?php


namespace App\Infrastructure\Adapter;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter
 */
class ResponseCase
{
    public string $message;

    /** @var mixed */
    public $data;

    public string $type;

    /**
     * ResponseCase constructor.
     * @param string $type
     * @param string $message
     * @param null $data
     */
    public function __construct(string $type, string $message, $data = null)
    {
        $this->message = $message;
        $this->data = $data;
        $this->type = $type;
    }
}