<?php


namespace App\Application\Filiere\Command;


use App\Application\Filiere\Dto\FiliereDto;
use App\Domain\Filiere\Entity\Filiere;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Interfaces\CommandInterface;

class FiliereCommand extends AbstractCommand implements CommandInterface
{

    /**
     * @param FiliereDto $filiereDto
     * @return void
     */
    public function create($filiereDto): void
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
    public function delete($filiere): void
    {
        $this->manager->remove($filiere);
        $this->add("error", "filière supprimer");
    }

    /**
     * @param FiliereDto $filiereDto
     * @return void
     */
    public function update($filiereDto)
    {
        $repo = $this->manager->getRepository(Filiere::class);
        $filiere = $repo->findOneBy(["id"=>$filiereDto->id]);

        $filiere->setNom(strtoupper($filiereDto->nom))
            ->setAlias(strtoupper($filiereDto->alias));

        $this->add("info", "modification effectuer");
    }
}