<?php

namespace App\Application\Forum\Command;

use App\Application\Forum\Dto\TopicDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Forum\Entity\Topic;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Interfaces\CommandInterface;
use DateTimeImmutable;

class TopicCommand extends AbstractCommand implements CommandInterface
{
    /**
     * @param TopicDto $topicDto
     * @return void
     */
    public function create($topicDto)
    {
        if (!$topicDto instanceof TopicDto && !$topicDto->author instanceof Utilisateur)
            return null;

        $topic = new Topic();

        $topic->setAuthor($topicDto->author)
            ->setName($topicDto->name)
            ->setContent($topicDto->content)
            ->setCreatedAt(new DateTimeImmutable('now'));
        foreach ($topicDto->tag as $tag) {
            $topic->addTag($tag);
        }

        $this->add("success", "Votre sujet a bien été ajouter a la file de discussion", $topic);
    }

    /**
     * @param TopicDto $topicDto
     * @return void
     */
    public function update($topicDto)
    {
        if (!$topicDto instanceof TopicDto && !$topicDto->author instanceof Utilisateur)
            return null;

        $topicRepo = $this->manager->getRepository(Topic::class);

        $topic = $topicRepo->findOneBy(["id" => $topicDto->id]);

        if ($topic->getAuthor() != $topicDto->author) {
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

    /**
     * @param Topic $topic
     */
    public function delete($topic)
    {
        if (!$topic instanceof Topic)
            return;

        $this->manager->remove($topic);

        $this->add("info", "Le sujet à été supprimer");
    }

}
