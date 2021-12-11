<?php


namespace App\Service\Enseignement;


use App\Entity\Enseignement\Cour;
use App\Entity\Utilisateur\Utilisateur;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;

class CourService
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Cour $cour
     * @param Utilisateur $professeur
     * @return void
     */
    public function create(Cour $cour,Utilisateur $professeur) : void
    {
        $cour->setProfesseur($professeur)
            ->setPublishedAt(new DateTimeImmutable('now'));

        $this->manager->persist($cour);
        $this->manager->flush();
    }

    /**
     * @param Cour $cour
     * @return void
     */
    public function delete(Cour $cour) : void
    {
        $this->manager->remove($cour);
        $this->manager->flush();
    }
}