<?php


namespace App\Application\Forum\Dto;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Forum\Entity\Message;
use App\Domain\Forum\Entity\Topic;
use DateTimeImmutable;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Dto
 */
class MessageDto
{
    public ?DateTimeImmutable $updatedAt;
    public ?DateTimeImmutable $createdAt;
    public ?bool $accepted;
    public ?string $content;
    public ?Utilisateur $author;
    public ?Topic $topic;

    /**
     * MessageDto constructor.
     * @param Message|null $message
     */
    public function __construct(Message $message =null)
    {
        $this->topic = $message == null ? null : $message->getTopic();
        $this->author = $message == null ? null : $message->getAuthor();
        $this->content = $message == null ? null : $message->getContent();
        $this->accepted = $message == null ? null : $message->getAccepted();
        $this->createdAt = $message == null ? null : $message->getCreatedAt();
        $this->updatedAt = $message == null ? null : $message->getUpdatedAt();
    }
}