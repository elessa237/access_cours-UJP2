<?php


namespace App\Application\Niveau\Command;


use App\Application\Niveau\Dto\NiveauDto;
use App\Domain\Niveau\Entity\Niveau;
use App\Infrastructure\Adapter\AbstractCommand;

class NiveauCommand extends AbstractCommand
{

    /**
     * @param NiveauDto $niveauDto
     * @return void
     */
    public function create(NiveauDto $niveauDto) : void
    {
        $niveau = new Niveau();

        $niveau->setNom($niveauDto->nom)
            ->setAlias($niveauDto->alias);

        $this->add("success", "le nouveau niveau à été ajouter", $niveau);
    }

    /**
     * @param Niveau $niveau
     * @return void
     */
    public function delete(Niveau $niveau) : void
    {
        $this->manager->remove($niveau);
        $this->add("error", "supprimer action irreversible");
    }

    /**
     * @param NiveauDto $niveauDto
     */
    public function update(NiveauDto $niveauDto)
    {
        $repo = $this->manager->getRepository(Niveau::class);
        $niveau = $repo->findOneBy(["id"=>$niveauDto->id]);

        $niveau->setNom($niveauDto->nom)
            ->setAlias($niveauDto->alias);

        $this->add("info", "mise à jour effectué");
    }
}