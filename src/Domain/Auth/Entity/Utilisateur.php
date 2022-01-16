<?php

namespace App\Domain\Auth\Entity;

use App\Domain\Auth\Traits\SchoolInformationTrait;
use App\Domain\Auth\Traits\UserSecurityTrait;
use App\Domain\Auth\Traits\UserInformationTrait;
use App\Domain\Auth\Repository\UtilisateurRepository;
use App\Domain\Cour\Entity\Cour;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class Utilisateur
 * @package App\Entity\Utilisateur
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ORM\Table(name="Utilisateurs")
 * @UniqueEntity(fields={"email"}, message="Cette adresse email existe déja")
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    use UserInformationTrait;
    use UserSecurityTrait;
    use SchoolInformationTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\OneToMany(targetEntity=Cour::class, mappedBy="professeur")
     */
    private Collection $cours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $poste = null;

    public function __construct()
    {
        $this->cours = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return  $this->email;
    }

    /**
     * @return string
     */
    public function getUsername() : string
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

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function __toString()
    {
        return $this->getUserIdentifier();
    }

    public function getSalt()
    {
    }


    public function eraseCredentials()
    {
    }

}
