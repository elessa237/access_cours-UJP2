<?php


namespace App\Application\Forum\Command;


use App\Application\Forum\Dto\MessageDto;
use App\Domain\Forum\Entity\Message;
use App\Domain\Forum\Entity\Topic;
use App\Domain\Forum\Event\TopicSolveEvent;
use App\Infrastructure\Adapter\AbstractCommand;
use DateTimeImmutable;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Command
 */
class MessageCommand extends AbstractCommand
{
    public function new(MessageDto $messageDto)
    {
        $message = new Message();

        $message->setAuthor($messageDto->author)
            ->setContent($messageDto->content)
            ->setTopic($messageDto->topic)
            ->setAccepted(false)
            ->setCreatedAt(new DateTimeImmutable());

        $this->manager->persist($message);
        $this->manager->flush();
    }

    /**
     * @param int $messageId
     * @param int $topicId
     * @return string
     */
    public function accepted(int $messageId, int $topicId) : string
    {
        $message = $this->manager->getRepository(Message::class)->findOneBy(["id"=>$messageId]);
        $topic = $this->manager->getRepository(Topic::class)->findOneBy(['id'=>$topicId]);
        $message->setAccepted(true);
        $this->manager->flush();
        $this->dispatch(new TopicSolveEvent($topic));
        return "Le sujet a bien été marqué comme accepté";
    }
}