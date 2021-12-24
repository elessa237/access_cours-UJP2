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
    public ?int $id;
    public ?string $nom;
    public ?Niveau $niveau;
    public ?Collection $filieres;

    public function __construct(?Ue $ue = null)
    {
        $this->id = $ue === null? null : $ue->getId();
        $this->nom = $ue === null? null : $ue->getNom();
        $this->niveau = $ue === null? null : $ue->getNiveau();
        $this->filieres = $ue === null? null : $ue->getFilieres();
    }
}