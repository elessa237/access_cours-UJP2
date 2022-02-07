<?php


namespace App\Application\Ue\Command;


use App\Application\Ue\Dto\UeDto;
use App\Domain\Ue\Entity\Ue;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Interfaces\CommandInterface;

class UeCommand extends AbstractCommand implements CommandInterface
{

    /**
     * @param UeDto $ueDto
     * @return void
     */
    public function create($ueDto): void
    {
        if (!$ueDto instanceof UeDto)
            return;

        $ue = new Ue();

        $ue->setNom($ueDto->nom)
            ->setNiveau($ueDto->niveau);
        foreach ($ueDto->filieres as $filiere) {
            $ue->addFiliere($filiere);
        }
        $this->add("success", "l'unité d'enseignement a bien été ajouter", $ue);

    }

    /**
     * @param Ue $ue
     * @return void
     */
    public function delete($ue): void
    {
        $this->manager->remove($ue);
        $this->add("error", "action irreversible");
    }

    public function update($ueDto)
    {
        if (!$ueDto instanceof UeDto)
            return;

        $repo = $this->manager->getRepository(Ue::class);
        $ue = $repo->findOneBy(["id" => $ueDto->id]);

        $ue->setNom($ueDto->nom)
            ->setNiveau($ueDto->niveau);
        foreach ($ueDto->filieres as $filiere) {
            $ue->addFiliere($filiere);
        }

        $this->add("info", "mise à jour effectué");
    }
}