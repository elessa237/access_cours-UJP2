<?php


namespace App\Domain\Forum\Entity;


use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\BaseTimeTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Domain\Forum\Repository\TopicRepository;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Forum\Entity
 * @ORM\Entity(repositoryClass=TopicRepository::class)
 * @ORM\Table(name="forum_topic")
 */
class Topic
{
    use BaseTimeTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=70)
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="70")
     */
    private string $name = '';

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     */
    private ?string $content = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Auth\Entity\Utilisateur")
     * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
     */
    private ?Utilisateur $author = null;

    /**
     * @ORM\Column(type="boolean", options={"default":0})
     */
    private ?bool $solved = false;

    /**
     * @ORM\ManyToMany(targetEntity="App\Domain\Forum\Entity\Tag", inversedBy="topics")
     * @Assert\NotBlank()
     * @Assert\Count(min="1", max="3")
     */
    private ?Collection $tags = null;

    /**
     * @ORM\OneToMany(targetEntity="App\Domain\Forum\Entity\Message", mappedBy="topic")
     */
    private ?Collection $messages = null;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return bool|null
     */
    public function getSolved(): ?bool
    {
        return $this->solved;
    }

    /**
     * @param bool|null $solved
     * @return self
     */
    public function setSolved(?bool $solved): self
    {
        $this->solved = $solved;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    public function addTag(?Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(?Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
        }

        return $this;
    }

    /**
     * @return Utilisateur
     */
    public function getAuthor(): ?Utilisateur
    {
        return $this->author;
    }

    /**
     * @param Utilisateur $author
     * @return self
     */
    public function setAuthor(?Utilisateur $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): ?Collection
    {
        return $this->messages;
    }
}