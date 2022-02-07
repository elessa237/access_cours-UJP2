<?php


namespace App\Infrastructure\Adapter\Validator;


/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Adapter\Validator
 */
Abstract class Validate
{

    static function notNull(string $text) : bool
    {
        return empty($text) === false;
    }

    static function equalTo(string $first, string $second) : bool
    {
        return $first === $second;
    }

    static function email(string $email) : bool
    {
        $regex =
            "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";

        if(preg_match($regex, $email))  {
            return true;
        }
        return  false;
    }

    static function password($password) : bool
    {
        $regex = "/^[a-zA-Z0-9]{8,}$/";

        return preg_match($regex, $password) ? true : false;
    }
}