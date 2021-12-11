<?php


namespace App\Service\InfoEtudiant;


use App\Entity\InfoEtudiant\Filiere;
use Doctrine\ORM\EntityManagerInterface;

class FiliereService
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param Filiere $filiere
     * @param $form
     * @return void
     */
    public function create(Filiere $filiere, $form) : void
    {
        $filiere->setNom(strtoupper($form->get('nom')->getData()))
            ->setAlias(strtoupper($form->get('alias')->getData()));

        $this->manager->persist($filiere);
        $this->manager->flush();
    }

    /**
     * @param Filiere $filiere
     * @return void
     */
    public function delete(Filiere $filiere) : void
    {
        $this->manager->remove($filiere);
        $this->manager->flush();
    }

}