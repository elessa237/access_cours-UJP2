<?php

namespace App\Domain\Cour\Entity;

use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Repository\CourRepository;
use App\Domain\Ue\Entity\Ue;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use \App\Domain\Filiere\Entity\Filiere;

/**
 * @ORM\Entity(repositoryClass=CourRepository::class)
 * @ORM\Table(name="Cours")
 * @Vich\Uploadable
 */
class Cour
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string")
     * @Groups("cour:read")
     */
    private ?string $nom = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("cour:read")
     */
    private ?string $nomCour = null;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="cours", fileNameProperty="nomCour", size="tailleCour")
     * @Assert\File(
     *     mimeTypes = {"application/pdf", "application/x-pdf"},
     *     mimeTypesMessage = "Seul les pdf sont accepter"
     * )
     */
    private ?File $cour = null;

    /**
     * @ORM\Column(type="integer")
     * @Groups("cour:read")
     */
    private ?int $tailleCour;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups("cour:read")
     */
    private ?DateTimeImmutable $publishedAt = null;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $UpdatedAt = null;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("cour:read")
     */
    private ?Utilisateur $professeur = null;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Niveau $niveau = null;

    /**
     * @ORM\ManyToOne(targetEntity=Ue::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("cour:read")
     */
    private ?UE $UE = null;

    /**
     * @ORM\ManyToMany(targetEntity=Filiere::class, inversedBy="cours")
     */
    private ?Collection $filieres = null;

    public function __construct()
    {
        $this->filieres = new ArrayCollection();
    }


    public function getId(): int
    {
        return $this->id;
    }

    public function getNomCour(): ?string
    {
        return $this->nomCour;
    }

    public function setNomCour(?string $nomCour): void
    {
        $this->nomCour = $nomCour;
    }

    public function getPublishedAt(): ?DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getProfesseur(): ?Utilisateur
    {
        return $this->professeur;
    }

    public function setProfesseur(Utilisateur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getNiveau(): ?Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getUE(): ?Ue
    {
        return $this->UE;
    }

    public function setUE(Ue $UE): self
    {
        $this->UE = $UE;

        return $this;
    }

    /**
     * @return File|null
     */
    public function getCour(): ?File
    {
        return $this->cour;
    }

    /**
     * @param File|UploadedFile|null $cour
     */
    public function setCour(?File $cour = null): self
    {
        $this->cour = $cour;
        if (null !== $cour)
        {
            $this->UpdatedAt = new DateTimeImmutable('now');
        }
        return $this;
    }

    /**
     * @return int
     */
    public function getTailleCour(): int
    {
        return $this->tailleCour;
    }

    /**
     * @param int $tailleCour
     */
    public function setTailleCour(?int $tailleCour): void
    {
        $this->tailleCour = $tailleCour;
    }

    /**
     * @return string
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFilieres(): ?Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filieres): self
    {
        if (!$this->filieres->contains($filieres)) {
            $this->filieres[] = $filieres;
        }

        return $this;
    }

    public function removeFiliere(Filiere $filieres): self
    {
        $this->filieres->removeElement($filieres);

        return $this;
    }

    public function __toString()
    {
        return $this->nomCour;
    }

}
