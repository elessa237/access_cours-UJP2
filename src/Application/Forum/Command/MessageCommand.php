<?php


namespace App\Application\Forum\Command;


use App\Application\Forum\Dto\MessageDto;
use App\Domain\Forum\Entity\Message;
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

    public function accepted(Message $message)
    {
        $message->setAccepted(true);
        $this->manager->flush();
    }
}