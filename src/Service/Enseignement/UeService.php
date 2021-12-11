<?php


namespace App\Service\Enseignement;


use App\Entity\Enseignement\UE;
use Doctrine\ORM\EntityManagerInterface;

class UeService
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param UE $ue
     * @return void
     */
    public function create(UE $ue) : void
    {
        $this->manager->persist($ue);
        $this->manager->flush();
    }

    /**
     * @param UE $ue
     * @return void
     */
    public function delete(UE $ue) : void
    {
        $this->manager->remove($ue);
        $this->manager->flush();
    }
}