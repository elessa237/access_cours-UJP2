<?php

namespace App\Domain\Ue\Entity;
use App\Domain\Cour\Entity\Cour;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Ue\Repository\UeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use \App\Domain\Filiere\Entity\Filiere;

/**
 * @ORM\Entity(repositoryClass=UeRepository::class)
 * @ORM\Table(name="Unite_enseignement")
 */
class Ue
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
    private ?string $nom = null;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="uEs")
     * @ORM\JoinColumn(nullable=false)
     */
    private ?Niveau $niveau = null;

    /**
     * @ORM\OneToMany(targetEntity=Cour::class, mappedBy="UE")
     */
    private Collection $cours;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class, mappedBy="UE")
     */
    private Collection $etudiants;

    /**
     * @ORM\ManyToMany(targetEntity=Filiere::class, inversedBy="unite_enseignements")
     */
    private Collection $filieres;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->etudiants = new ArrayCollection();
        $this->filieres = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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

    /**
     * @return Collection|Filiere[]
     */
    public function getFilieres(): Collection
    {
        return $this->filieres;
    }

    public function addFiliere(Filiere $filiere): self
    {
        if (!$this->filieres->contains($filiere)) {
            $this->filieres[] = $filiere;
        }

        return $this;
    }

    public function removeFiliere(Filiere $filiere): self
    {
        $this->filieres->removeElement($filiere);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

}
