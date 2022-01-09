<?php


namespace App\Domain\Auth\Event;


use App\Domain\Auth\Entity\Utilisateur;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Authenticator
 */
class AuthSuccessEvent
{

    private Utilisateur $user;

    /**
     * AuthSuccessEvent constructor.
     * @param Utilisateur $user
     */
    public function __construct(Utilisateur $user)
    {
        $this->user = $user;
    }


    public function getUser(): Utilisateur
    {
        return $this->user;
    }
}