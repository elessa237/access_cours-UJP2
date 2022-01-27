<?php

namespace App\Application\Forum\Command;

use App\Application\Forum\Dto\TopicDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Forum\Entity\Topic;
use App\Infrastructure\Adapter\AbstractCommand;
use DateTimeImmutable;

class TopicCommand extends AbstractCommand
{
    public function create(TopicDto $topicDto,Utilisateur $user)
    {
        $topic = new Topic();

        $topic->setAuthor($user)
            ->setName($topicDto->name)
            ->setContent($topicDto->content)
            ->setCreatedAt(new DateTimeImmutable('now'));
        foreach ($topicDto->tag as $tag) {
            $topic->addTag($tag);
        }

        $this->add("success", "Votre sujet a bien été ajouter a la file de discussion", $topic);
    }

    public function update(TopicDto $topicDto, Utilisateur $user)
    {
        $topicRepo = $this->manager->getRepository(Topic::class);

        $topic = $topicRepo->findOneBy(["id" => $topicDto->id]);

        if ($topic->getAuthor() != $user) {
            return;
        }

        $topic->setName($topicDto->name)
            ->setContent($topicDto->content)
            ->setUpdatedAt(new DateTimeImmutable('now'));
        foreach ($topicDto->tag as $tag) {
            $topic->addTag($tag);
        }

        $this->add("info", "Votre sujet a bien été mis a jour", $topic);
    }

    public function delete(Topic $topic)
    {
        $this->manager->remove($topic);

        $this->add("info", "Le sujet à été supprimer");
    }
}
