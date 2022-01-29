<?php


namespace App\Domain\Forum\Entity;


use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Traits\BaseTimeTrait;
use App\Domain\Forum\Repository\MessageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Forum\Entity
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 */
class Message
{
    use BaseTimeTrait;
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Forum\Entity\Topic", inversedBy="messages")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Topic $topic = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Auth\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Utilisateur $author = null;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private bool $accepted = false;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private ?string $content = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Topic
     */
    public function getTopic(): ?Topic
    {
        return $this->topic;
    }

    /**
     * @param Topic $topic
     * @return self
     */
    public function setTopic(Topic $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    /**
     * @return Utilisateur|null
     */
    public function getAuthor(): ?Utilisateur
    {
        return $this->author;
    }

    /**
     * @param Utilisateur $author
     * @return self
     */
    public function setAuthor(Utilisateur $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAccepted(): bool
    {
        return $this->accepted;
    }

    /**
     * @param bool $accepted
     * @return self
     */
    public function setAccepted(bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return self
     */
    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

}