<?php


namespace App\Application\Cour\Dto;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Class CourDto
 * @package App\Application\Cour\Dto
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class CourDto
{
    public ?string $nom;
    public ?File $cour;
    public ?DateTimeImmutable $publishedAt;
    public ?DateTimeImmutable $updatedAt;
    public ?Utilisateur $professeur;
    public ?Niveau $niveau;
    public ?UE $UE;
    public ?Collection $filieres;

    public function __construct(?Cour $cour = null)
    {
        $this->nom = $cour === null ? null : $cour->getNom();
        $this->cour = $cour === null ? null : $cour->getCour();
        $this->publishedAt = $cour === null ? null : $cour->getPublishedAt();
        $this->updatedAt = $cour === null ? null : $cour->getUpdatedAt();
        $this->professeur = $cour === null ? null : $cour->getProfesseur();
        $this->niveau = $cour === null ? null : $cour->getNiveau();
        $this->UE = $cour === null ? null : $cour->getUE();
        $this->filieres = $cour === null ? null : $cour->getFilieres();
    }
}