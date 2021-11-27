<?php

namespace App\Entity\Enseignement;

use App\Entity\InfoEtudiant\Niveau;
use App\Entity\Utilisateur\Utilisateur;
use App\Repository\Enseignement\CourRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use \App\Entity\InfoEtudiant\Filiere;

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
     */
    private string $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private ?string $nomCour = null;

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="cours", fileNameProperty="nomCour", size="tailleCour")
     */
    private ?File $cour;

    /**
     * @ORM\Column(type="integer")
     */
    private ?int $tailleCour;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $publishedAt;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private DateTimeImmutable $UpdatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private Utilisateur $professeur;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private Niveau $niveau;

    /**
     * @ORM\ManyToOne(targetEntity=UE::class, inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
    private UE $UE;

    /**
     * @ORM\OneToMany(targetEntity=Filiere::class, mappedBy="cour")
     */
    private Collection $filiere;

    public function __construct()
    {
        $this->filiere = new ArrayCollection();
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

    public function getPublishedAt(): DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(DateTimeImmutable $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    public function getProfesseur(): Utilisateur
    {
        return $this->professeur;
    }

    public function setProfesseur(Utilisateur $professeur): self
    {
        $this->professeur = $professeur;

        return $this;
    }

    public function getNiveau(): Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(Niveau $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getUE(): UE
    {
        return $this->UE;
    }

    public function setUE(UE $UE): self
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
    public function setCour(?File $cour = null): void
    {
        $this->cour = $cour;
        if (null !== $cour)
        {
            $this->UpdatedAt = new DateTimeImmutable('now');
        }
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
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return Collection|Filiere[]
     */
    public function getFiliere(): Collection
    {
        return $this->filiere;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filiere->contains($filiere)) {
            $this->filiere[] = $filiere;
            $filiere->setCour($this);
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        if ($this->filiere->removeElement($filiere)) {
            // set the owning side to null (unless already changed)
            if ($filiere->getCour() === $this) {
                $filiere->setCour(null);
            }
        }

        return $this;
    }
}
