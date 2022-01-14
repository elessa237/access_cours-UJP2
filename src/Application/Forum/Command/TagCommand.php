<?php

namespace App\Application\Forum\Command;

use App\Domain\Forum\Entity\Tag;
use App\Application\Forum\Dto\TagDto;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @package App\Application\Filiere\Command
 * @author Elessa Maxime <elessamaxime@icloud.com.com>
 */
class TagCommand
{
    private EntityManagerInterface $manager;
    private RequestStack $requestStack;

    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;

    }

    public function create(TagDto $tagDto)
    {
        $tag = new Tag();

        $tag->setName($tagDto->name)
            ->setColor($tagDto->color)
            ->setDescription($tagDto->description)
            ->setVisible(true)
            ->setCreatedAt(new DateTimeImmutable('now'))
        ;
    
        $this->persist("sucess", "Le tag {$tagDto->name} a bien été ajouté",$tag);
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

        $this->persist("info", "Le tag {$tagDto->name} a bien été mis a jour");
    }

    public function delete(Tag $tag)
    {
        $this->manager->remove($tag);

        $this->persist("error", "Le tag a bien été supprimer");
    }

    private function persist(string $type, string $message,
    $data = null) : void
    {

        if ($data) {
            $this->manager->persist($data);
        }

        $this->manager->flush();

        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add($type, $message);
    }
}
