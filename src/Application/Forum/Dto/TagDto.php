<?php


namespace App\Application\Forum\Dto;


use App\Domain\Forum\Entity\Tag;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Dto
 */
class TagDto
{
    public ?DateTimeImmutable $updatedAt;
    public ?DateTimeImmutable $createdAt;
    public ?Collection $topic;
    public ?string $color;
    public ?string $description;
    public ?string $name;
    public ?bool $visible;
    public ?int $id;

    /**
     * TagDto constructor.
     * @param Tag|null $tag
     */
    public function __construct(Tag $tag = null)
    {
        $this->id = $tag == null ? null : $tag->getId();
        $this->name = $tag == null ? null : $tag->getName();
        $this->description = $tag == null ? null : $tag->getDescription();
        $this->color = $tag == null ? null : $tag->getColor();
        $this->topic = $tag == null ? null : $tag->getTopics();
        $this->visible = $tag == null ? null : $tag->getVisible();
        $this->createdAt = $tag == null ? null : $tag->getCreatedAt();
        $this->updatedAt = $tag == null ? null : $tag->getUpdatedAt();
    }
}