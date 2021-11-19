<?php

namespace App\Entity\Utilisateur;

use App\Entity\Enseignement\UE;
use App\Entity\InfoEtudiant\Filiere;
use App\Entity\InfoEtudiant\Niveau;
use App\Repository\Utilisateur\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 * @ORM\Table(name="Etudiants")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class Etudiant extends Utilisateur
{
    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private Filiere $filiere;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="veillez renseigner votre niveau")
     */
    private Niveau $niveau;

    /**
     * @ORM\ManyToMany(targetEntity=UE::class, inversedBy="etudiants")
     * @Assert\NotBlank(message="Veuillez renseigner votre filliere")
     */
    private Collection $UE;

    public function __construct()
    {
        $this->roles = ['ROLE_ETUDIANT'];
        $this->UE = new ArrayCollection();
    }

    public function getFiliere(): Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(Filiere $filiere): self
    {
        $this->filiere = $filiere;

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
     * @return Collection|UE[]
     */
    public function getUE(): Collection
    {
        return $this->UE;
    }

    public function addUE(UE $uE): self
    {
        if (!$this->UE->contains($uE)) {
            $this->UE[] = $uE;
        }

        return $this;
    }

    public function removeUE(UE $uE): self
    {
        $this->UE->removeElement($uE);

        return $this;
    }
}
