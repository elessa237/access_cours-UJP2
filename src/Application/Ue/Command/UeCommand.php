<?php


namespace App\Application\Ue\Command;


use App\Application\Ue\Dto\UeDto;
use App\Domain\Ue\Entity\Ue;
use Doctrine\ORM\EntityManagerInterface;

class UeCommand
{
    private EntityManagerInterface $manager;
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param UeDto $ueDto
     * @return void
     */
    public function create(UeDto $ueDto) : void
    {
        $ue = new Ue();

        $ue->setNom($ueDto->nom)
            ->setNiveau($ueDto->niveau);
            foreach($ueDto->filieres as $filiere)
            {
                $ue->addFiliere($filiere);
            }

        $this->manager->persist($ue);
        $this->manager->flush();
    }

    /**
     * @param Ue $ue
     * @return void
     */
    public function delete(Ue $ue) : void
    {
        $this->manager->remove($ue);
        $this->manager->flush();
    }
}