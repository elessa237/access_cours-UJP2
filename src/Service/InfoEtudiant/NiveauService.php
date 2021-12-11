<?php


namespace App\Service\InfoEtudiant;


use App\Entity\InfoEtudiant\Niveau;
use Doctrine\ORM\EntityManagerInterface;

class NiveauService
{

    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Niveau $niveau
     * @return void
     */
    public function create(Niveau $niveau) : void
    {
        $this->manager->persist($niveau);
        $this->manager->flush();
    }

    /**
     * @param Niveau $niveau
     * @return void
     */
    public function delete(Niveau $niveau) : void
    {
        $this->manager->remove($niveau);
        $this->manager->flush();
    }
}