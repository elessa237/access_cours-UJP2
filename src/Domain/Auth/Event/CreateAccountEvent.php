<?php


namespace App\Domain\Auth\Event;


use App\Domain\Auth\Entity\Utilisateur;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Auth\Event
 */
class CreateAccountEvent extends Event
{
    private Utilisateur $student;

    public function __construct(Utilisateur $student)
    {
        $this->student = $student;
    }

    public function getStudent(): Utilisateur
    {
        return $this->student;
    }
}