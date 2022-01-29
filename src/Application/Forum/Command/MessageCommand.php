<?php


namespace App\Application\Forum\Command;


use App\Application\Forum\Dto\MessageDto;
use App\Domain\Forum\Entity\Message;
use App\Domain\Forum\Entity\Topic;
use App\Domain\Forum\Event\TopicSolveEvent;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Interfaces\CommandInterface;
use DateTimeImmutable;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Command
 */
class MessageCommand extends AbstractCommand implements CommandInterface
{
    /**
     * @param $messageDto
     * @return void
     */
    public function create($messageDto)
    {
        if (!$messageDto instanceof MessageDto)
            return;

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
     */
    public function accepted(int $messageId, int $topicId)
    {
        $message = $this->manager->getRepository(Message::class)->findOneBy(["id"=>$messageId]);
        $topic = $this->manager->getRepository(Topic::class)->findOneBy(['id'=>$topicId]);
        $message->setAccepted(true);
        $this->manager->flush();
        $this->dispatch(new TopicSolveEvent($topic));
    }

    /**
     * @param $objectDto
     * @return void
     */
    public function update($objectDto)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $object
     * @return void
     */
    public function delete($object)
    {
        // TODO: Implement delete() method.
    }
}