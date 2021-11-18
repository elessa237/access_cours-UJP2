<?php

namespace App\Entity\Utilisateur;

use App\Entity\Enseignement\Cour;
use App\Repository\Utilisateur\ProfesseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProfesseurRepository::class)
 * @ORM\Table(name="Professeurs")
 */
class Professeur extends Utilisateur
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $numero_cni;

    /**
     * @ORM\OneToMany(targetEntity=Cour::class, mappedBy="professeur")
     */
    private Collection $cours;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
        $this->roles = ['ROLE_PROFESSEUR'];
    }

    public function getNumeroCni(): ?string
    {
        return $this->numero_cni;
    }

    public function setNumeroCni(string $numero_cni): self
    {
        $this->numero_cni = $numero_cni;

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
            $cour->setProfesseur($this);
        }

        return $this;
    }

    public function removeCour(Cour $cour): self
    {
        if ($this->cours->removeElement($cour)) {
            // set the owning side to null (unless already changed)
            if ($cour->getProfesseur() === $this) {
                $cour->setProfesseur(null);
            }
        }

        return $this;
    }
}
