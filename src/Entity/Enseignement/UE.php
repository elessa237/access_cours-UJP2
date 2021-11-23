<?php

namespace App\Entity\Enseignement;

use App\Entity\InfoEtudiant\Niveau;
use App\Entity\Utilisateur\Utilisateur;
use App\Repository\Enseignement\UERepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UERepository::class)
 * @ORM\Table(name="Unite_enseignement")
 */
class UE
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255, name="nom_UE")
     */
    private string $nom;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="uEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private Niveau $niveau;

    /**
     * @ORM\OneToMany(targetEntity=Cour::class, mappedBy="UE")
     */
    private Collection $cours;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, mappedBy="UE")
     */
    private Collection $etudiants;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
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

    public function getNiveau(): Niveau
    {
        return $this->niveau;
    }

    public function setNiveau(Niveau $niveau): self
    {
        $this->niveau = $niveau;

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
            $cour->setUE($this);
        }

        return $this;
    }

    public function removeCour(Cour $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getUE() === $this) {
                $cour->setUE(null);
            }
        }

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
            $etudiant->addUE($this);
        }

        return $this;
    }

    public function removeEtudiant(Utilisateur $etudiant): self
    {
        if ($this->etudiants->removeElement($etudiant)) {
            $etudiant->removeUE($this);
        }

        return $this;
    }
}
