<?php

namespace App\Domain\Filiere\Entity;

use App\Domain\Cour\Entity\Cour;
use App\Domain\Ue\Entity\Ue;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Filiere\Repository\FiliereRepository;
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
     * @ORM\ManyToMany(targetEntity=Cour::class, mappedBy="filieres")
     */
    private Collection $cours;

    /**
     * @ORM\ManyToMany(targetEntity=Ue::class, mappedBy="filieres")
     */
    private Collection $unite_enseignements;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->cours = new ArrayCollection();
        $this->unite_enseignements = new ArrayCollection();
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

    public function __toString() : string
    {
        return $this->nom;
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
            $cour->addFiliere($this);
        }

        return $this;
    }

    public function removeCour(Cour $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            $cour->removeFiliere($this);
        }

        return $this;
    }

    /**
     * @return Collection|UE[]
     */
    public function getUniteEnseignements(): Collection
    {
        return $this->unite_enseignements;
    }

    public function addUniteEnseignement(UE $uniteEnseignement): self
    {
        if (!$this->unite_enseignements->contains($uniteEnseignement)) {
            $this->unite_enseignements[] = $uniteEnseignement;
            $uniteEnseignement->addFiliere($this);
        }

        return $this;
    }

    public function removeUniteEnseignement(UE $uniteEnseignement): self
    {
        if ($this->unite_enseignements->removeElement($uniteEnseignement)) {
            $uniteEnseignement->removeFiliere($this);
        }

        return $this;
    }

}
