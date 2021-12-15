<?php


namespace App\Application\Niveau\Dto;


use App\Domain\Niveau\Entity\Niveau;
use Doctrine\Common\Collections\Collection;

/**
 * Class NiveauDto
 * @package App\Application\Niveau\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class NiveauDto
{
    public ?string $nom;
    public ?string $alias;
    public ?Collection $etudiants;
    public ?Collection $uEs;
    public ?Collection $cours;

    public function __construct(?Niveau $niveau = null)
    {
        $this->nom = $niveau === null? null : $niveau->getNom();
        $this->alias = $niveau === null? null : $niveau->getAlias();
        $this->etudiants = $niveau === null? null : $niveau->getEtudiants();
        $this->uEs = $niveau === null? null : $niveau->getUEs();
        $this->cours = $niveau === null? null : $niveau->getCours();
    }
}