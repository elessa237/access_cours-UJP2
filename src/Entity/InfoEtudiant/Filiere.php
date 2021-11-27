<?php

namespace App\Entity\InfoEtudiant;

use App\Entity\Enseignement\Cour;
use App\Entity\Enseignement\UE;
use App\Entity\Utilisateur\Utilisateur;
use App\Repository\InfoEtudiant\FiliereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FiliereRepository::class)
 */
class Filiere
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $nom;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private string $alias;

    /**
     * @ORM\OneToMany(targetEntity=Utilisateur::class, mappedBy="filiere")
     */
    private Collection $etudiants;

    /**
     * @ORM\ManyToOne(targetEntity=UE::class, inversedBy="filiere")
     */
    private ?UE $unite_enseign;

    /**
     * @ORM\ManyToOne(targetEntity=Cour::class, inversedBy="filiere")
     */
    private ?Cour $cour;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Utilisateur $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setFiliere($this);
        }

        return $this;
    }

    public function removeEtudiant(Utilisateur $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getFiliere() === $this) {
                $etudiant->setFiliere(null);
            }
        }

        return $this;
    }

    public function getUniteEnseign(): ?UE
    {
        return $this->unite_enseign;
    }

    public function setUniteEnseign(?UE $unite_enseign): self
    {
        $this->unite_enseign = $unite_enseign;

        return $this;
    }

    public function __toString() : ?string
    {
        return $this->nom;
    }

    public function getCour(): ?Cour
    {
        return $this->cour;
    }

    public function setCour(?Cour $cour): self
    {
        $this->cour = $cour;

        return $this;
    }
}
