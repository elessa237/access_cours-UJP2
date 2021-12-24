<?php


namespace App\Application\Filiere\Dto;


use App\Domain\Filiere\Entity\Filiere;
use Doctrine\Common\Collections\Collection;

/**
 * Class FiliereDto
 * @package App\Application\Filiere\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class FiliereDto
{
    public ?string $nom;
    public ?string $alias;
    public ?Collection $etudiants;
    public ?Collection $cours;
    public ?Collection $unite_enseignements;
    public ?int $id;

    public function __construct(?Filiere $filiere = null)
    {
        $this->id = $filiere === null? null : $filiere->getId();
        $this->nom = $filiere === null? null : $filiere->getNom();
        $this->alias = $filiere === null? null : $filiere->getAlias();
        $this->etudiants = $filiere === null? null : $filiere->getEtudiants();
        $this->cours = $filiere === null? null : $filiere->getCours();
        $this->unite_enseignements = $filiere === null? null : $filiere->getUniteEnseignements();
    }
}