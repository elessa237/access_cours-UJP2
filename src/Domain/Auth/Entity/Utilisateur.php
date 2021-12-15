<?php

namespace App\Domain\Auth\Entity;

use App\Domain\Auth\Repository\UtilisateurRepository;
use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
use App\Domain\Cour\Entity\Cour;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

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
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private ?string $nom = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    private ?string $prenom = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private ?string $email = null;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^6[5-9][0-9]{7}$/", message="numero de telephone non valide")
     *
     */
    private ?string $numero_telephone = null;

    /**
     * @ORM\Column(type="json")
     */
    private array $roles = [];

    /**
     * @ORM\Column(type="string", length=255, name="mot_de_passe")
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="/^[a-zA-Z0-9]{8,}$/", message="8 caractères au minimum")
     */
    private ?string $password = null;

    /**
     * @var string
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passes saisie ne sont pas identique")
     */
    private ?string $confirmPassword = null;

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

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $numero_cni = null;

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
        $this->UE = new ArrayCollection();
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroTelephone(): ?string
    {
        return $this->numero_telephone;
    }

    public function setNumeroTelephone(?string $numero_telephone): self
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword() : ?string
    {
        return $this->password;
    }

    public function setPassword(string $mot_de_passe): self
    {
        $this->password = $mot_de_passe;

        return $this;
    }

    /**
     * @return string
     */
    public function getConfirmPassword(): ?string
    {
        return $this->confirmPassword;
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

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }

    public function getSalt()
    {
    }


    public function eraseCredentials()
    {
    }

}
