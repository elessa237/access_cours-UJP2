<?php

namespace App\Entity\Utilisateur;

use App\Repository\Utilisateur\AdministrationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdministrationRepository::class)
 */
class Administration extends Utilisateur
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $poste;

    public function __construct()
    {
        $this->roles = ['ROLE_ADMIM'];
    }


    public function getPoste(): string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }
}
