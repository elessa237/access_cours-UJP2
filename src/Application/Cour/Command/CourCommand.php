<?php


namespace App\Application\Cour\Command;

use App\Application\Cour\Dto\CourDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use App\Infrastructure\Adapter\AbstractCommand;
use DateTimeImmutable;

/**
 * Class CourCommand
 * @package App\Application\Cour\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class CourCommand extends AbstractCommand
{

    /**
     * @param CourDto $courDto
     * @param Utilisateur $professeur
     * @return void
     */
    public function create(CourDto $courDto, Utilisateur $professeur): void
    {
        $cour = new Cour();
        $cour
            ->setNom($courDto->nom)
            ->setCour($courDto->cour)
            ->setNiveau($courDto->niveau)
            ->setUE($courDto->UE)
            ->setProfesseur($professeur)
            ->setPublishedAt(new DateTimeImmutable('now'));

        foreach ($courDto->filieres as $filiere)
        {
            $cour->addFiliere($filiere);
        }

        $this->add("success", "un cours de plus dans la base de donnée", $cour);
    }

    /**
     * @param Cour $cour
     * @return void
     */
    public function delete(Cour $cour): void
    {
        $this->manager->remove($cour);
        $this->add("error", "dommage qu'il est fallu le supprimer");
    }

    public function update(CourDto $courDto)
    {
        $repo = $this->manager->getRepository(Cour::class);

        $cour = $repo->findOneBy(["id" => $courDto->id]);

        $cour
            ->setNom($courDto->nom)
            ->setCour($courDto->cour)
            ->setNiveau($courDto->niveau)
            ->setUE($courDto->UE)
            ->setProfesseur($courDto->professeur)
            ->setPublishedAt(new DateTimeImmutable('now'));

        foreach ($courDto->filieres as $filiere)
        {
            $cour->addFiliere($filiere);
        }

        $this->add("info", "mise a jour effectué");
    }
}