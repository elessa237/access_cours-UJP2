<?php


namespace App\Application\Ue\Dto;


use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
use Doctrine\Common\Collections\Collection;

/**
 * Class UeDto
 * @package App\Application\Ue\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UeDto
{
    public ?string $nom;
    public ?Niveau $niveau;
    public ?Collection $cours;
    public ?Collection $etudiants;
    public ?Collection $filieres;

    public function __construct(?Ue $ue)
    {
        $this->nom = $ue === null? null : $ue->getNom();
        $this->niveau = $ue === null? null : $ue->getNiveau();
        $this->cours = $ue === null? null : $ue->getCours();
        $this->etudiants = $ue === null? null : $ue->getEtudiants();
        $this->filieres = $ue === null? null : $ue->getFilieres();
    }
}