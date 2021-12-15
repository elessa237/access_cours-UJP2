<?php


namespace App\Application\Cour\Command;

use App\Application\Cour\Dto\CourDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class CourCommand
 * @package App\Application\Cour\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class CourCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

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

        $this->manager->persist($cour);
        $this->manager->flush();
    }

    /**
     * @param Cour $cour
     * @return void
     */
    public function delete(Cour $cour): void
    {
        $this->manager->remove($cour);
        $this->manager->flush();
    }
}