<?php

namespace App\Application\Forum\Command;

use App\Domain\Forum\Entity\Tag;
use App\Application\Forum\Dto\TagDto;
use App\Infrastructure\Adapter\AbstractCommand;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @package App\Application\Filiere\Command
 * @author Elessa Maxime <elessamaxime@icloud.com.com>
 */
class TagCommand extends AbstractCommand
{

    public function create(TagDto $tagDto)
    {
        $tag = new Tag();

        $tag->setName(strtolower($tagDto->name))
            ->setColor($tagDto->color)
            ->setDescription($tagDto->description)
            ->setVisible(true)
            ->setCreatedAt(new DateTimeImmutable('now'))
        ;
    
        $this->add("sucess", "Le tag {$tagDto->name} a bien été ajouté",$tag);
    }

    public function update(TagDto $tagDto)
    {
        $tagRepo = $this->manager->getRepository(Tag::class);

        $tag = $tagRepo->findOneBy(['id' => $tagDto->id]);

        $tag->setName($tagDto->name)
            ->setColor($tagDto->color)
            ->setDescription($tagDto->description)
            ->setVisible(true)
            ->setUpdatedAt(new DateTimeImmutable('now'));

        $this->add("info", "Le tag {$tagDto->name} a bien été mis a jour");
    }

    public function delete(Tag $tag)
    {
        $this->manager->remove($tag);

        $this->add("error", "Le tag a bien été supprimer");
    }

}
