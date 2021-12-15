<?php


namespace App\Application\Filiere\Command;


use App\Application\Filiere\Dto\FiliereDto;
use App\Domain\Filiere\Entity\Filiere;
use Doctrine\ORM\EntityManagerInterface;

class FiliereCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param FiliereDto $filiereDto
     * @return void
     */
    public function create(FiliereDto $filiereDto): void
    {
        $filiere = new Filiere();

        $filiere->setNom(strtoupper($filiereDto->nom))
            ->setAlias(strtoupper($filiereDto->alias));

        $this->manager->persist($filiere);
        $this->manager->flush();
    }

    /**
     * @param FiliereDto $filiere
     * @return void
     */
    public function delete(FiliereDto $filiere): void
    {
        $this->manager->remove($filiere);
        $this->manager->flush();
    }
}