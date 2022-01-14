<?php


namespace App\Application\Forum\Dto;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Forum\Entity\Topic;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Dto
 */
class TopicDto
{
    public ?DateTimeImmutable $updatedAt;
    public ?DateTimeImmutable $createdAt;
    public ?int $id;
    public ?bool $solved;
    public ?string $content;
    public ?string $name;
    public ?Collection $tag;
    public ?Utilisateur $author;
    private ?Collection $messages;

    public function __construct(Topic $topic = null)
    {

        $this->id = $topic == null ? null : $topic->getId();
        $this->name = $topic == null ? null : $topic->getName();
        $this->content = $topic == null ? null : $topic->getContent();
        $this->solved = $topic == null ? null : $topic->getSolved();
        $this->tag = $topic == null ? null : $topic->getTags();
        $this->author = $topic == null ? null : $topic->getAuthor();
        $this->messages = $topic == null ? null : $topic->getMessages();
        $this->createdAt = $topic == null ? null : $topic->getCreatedAt();
        $this->updatedAt = $topic == null ? null : $topic->getUpdatedAt();
    }

}