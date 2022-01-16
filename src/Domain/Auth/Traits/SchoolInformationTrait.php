<?php


namespace App\Domain\Auth\Traits;


use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Auth\Traits
 */
trait SchoolInformationTrait
{
    /**
     * @ORM\ManyToOne(targetEntity=Filiere::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Filiere $filiere = null;

    /**
     * @ORM\ManyToOne(targetEntity=Niveau::class, inversedBy="etudiants")
     * @ORM\JoinColumn(nullable=true)
     */
    private ?Niveau $niveau = null;

    /**
     * @ORM\ManyToMany(targetEntity=Ue::class, inversedBy="etudiants")
     */
    private Collection $UE;

    public function __construct()
    {
        $this->UE = new ArrayCollection();
    }


    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(Filiere $filiere): self
    {
        $this->filiere = $filiere;

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