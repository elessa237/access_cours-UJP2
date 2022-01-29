<?php

namespace App\Application\Forum\Command;


use App\Domain\Forum\Entity\Tag;
use App\Application\Forum\Dto\TagDto;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Interfaces\CommandInterface;
use DateTimeImmutable;

/**
 * @package App\Application\Filiere\Command
 * @author Elessa Maxime <elessamaxime@icloud.com.com>
 */
class TagCommand extends AbstractCommand implements CommandInterface
{

    /**
     * @param TagDto $tagDto
     */
    public function create($tagDto)
    {
        if (!$tagDto instanceof TagDto)
            return;

        $tag = new Tag();

        $tag->setName(strtolower($tagDto->name))
            ->setColor($tagDto->color)
            ->setDescription($tagDto->description)
            ->setVisible(true)
            ->setCreatedAt(new DateTimeImmutable('now'))
        ;
    
        $this->add("success", "Le tag {$tagDto->name} a bien été ajouté",$tag);
    }

    /**
     * @param TagDto $tagDto
     * @return void
     */
    public function update($tagDto)
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

    /**
     * @param Tag $tag
     * @return void
     */
    public function delete($tag)
    {
        if (!$tag instanceof Tag)
            return;

        $this->manager->remove($tag);

        $this->add("error", "Le tag a bien été supprimer");
    }

}
