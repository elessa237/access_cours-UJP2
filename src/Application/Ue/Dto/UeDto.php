<?php


namespace App\Application\Ue\Dto;



use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;

/**
 * Class UeDto
 * @package App\Application\Ue\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UeDto
{
    public ?string $nom;
    public ?Niveau $niveau;
    public ?Filiere $filieres;

    public function __construct(?Ue $ue)
    {
        $this->nom = $ue === null? null : $ue->getNom();
        $this->niveau = $ue === null? null : $ue->getNiveau();
        $this->filieres = $ue === null? null : $ue->getFilieres();
    }
}