<?php

namespace App\Entity\InfoEtudiant;

use App\Entity\Enseignement\Cour;
use App\Entity\Enseignement\UE;
use App\Entity\Utilisateur\Etudiant;
use App\Repository\InfoEtudiant\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NiveauRepository::class)
 */
class Niveau
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
     * @ORM\Column(type="string", length=5)
     */
    private string $alias;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="niveau")
     */
    private Collection $etudiants;

    /**
     * @ORM\OneToMany(targetEntity=UE::class, mappedBy="niveau")
     */
    private Collection $uEs;

    /**
     * @ORM\OneToMany(targetEntity=Cour::class, mappedBy="niveau")
     */
    private Collection $cours;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->uEs = new ArrayCollection();
        $this->cours = new ArrayCollection();
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
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setNiveau($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getNiveau() === $this) {
                $etudiant->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UE[]
     */
    public function getUEs(): Collection
    {
        return $this->uEs;
    }

    public function addUE(UE $uE): self
    {
        if (!$this->uEs->contains($uE)) {
            $this->uEs[] = $uE;
            $uE->setNiveau($this);
        }

        return $this;
    }

    public function removeUE(UE $uE): self
    {
        if ($this->uEs->removeElement($uE)) {
            // set the owning side to null (unless already changed)
            if ($uE->getNiveau() === $this) {
                $uE->setNiveau(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Cour[]
     */
    public function getCours(): Collection
    {
        return $this->cours;
    }

    public function addCour(Cour $cour): self
    {
        if (!$this->cours->contains($cour)) {
            $this->cours[] = $cour;
            $cour->setNiveau($this);
        }

        return $this;
    }

    public function removeCour(Cour $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getNiveau() === $this) {
                $cour->setNiveau(null);
            }
        }

        return $this;
    }

    public function __toString() : ?string
    {
        return $this->nom;
    }
}
