<?php


namespace App\Application\Filiere\Command;


use App\Application\Filiere\Dto\FiliereDto;
use App\Domain\Filiere\Entity\Filiere;
use App\Infrastructure\Adapter\AbstractCommand;

class FiliereCommand extends AbstractCommand
{

    /**
     * @param FiliereDto $filiereDto
     * @return void
     */
    public function create(FiliereDto $filiereDto): void
    {
        $filiere = new Filiere();

        $filiere->setNom(strtoupper($filiereDto->nom))
            ->setAlias(strtoupper($filiereDto->alias));

        $this->add("success", "et une nouvelle filiere", $filiere);
    }

    /**
     * @param Filiere $filiere
     * @return void
     */
    public function delete(Filiere $filiere): void
    {
        $this->manager->remove($filiere);
        $this->add("error", "filière supprimer");
    }

    public function update(FiliereDto $filiereDto)
    {
        $repo = $this->manager->getRepository(Filiere::class);
        $filiere = $repo->findOneBy(["id"=>$filiereDto->id]);

        $filiere->setNom(strtoupper($filiereDto->nom))
            ->setAlias(strtoupper($filiereDto->alias));

        $this->add("info", "modification effectuer");
    }
}