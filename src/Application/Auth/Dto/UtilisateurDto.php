<?php


namespace App\Application\Auth\Dto;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Niveau\Entity\Niveau;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;

class UtilisateurDto
{
    public ?string $nom;
    public ?string $prenom;
    public ?string $email;
    public ?string $numero_telephone;
    public ?string $password;
    public ?string $confirmPassword;
    public ?Filiere $filiere;
    public ?Niveau $niveau;
    public ?Collection $UE;
    public ?string $numero_cni;
    public ?string $poste;
    public ?int $id;
    public ?string $resetPasswordToken;
    public ?string $registrationToken;
    public ?bool $isVerified;

    public function __construct(?Utilisateur $utilisateur = null)
    {
        $this->id = $utilisateur === null? null : $utilisateur->getId();
        $this->nom = $utilisateur === null? null : $utilisateur->getNom();
        $this->prenom = $utilisateur === null? null : $utilisateur->getPrenom();
        $this->email = $utilisateur === null? null : $utilisateur->getEmail();
        $this->numero_telephone = $utilisateur === null? null : $utilisateur->getNumeroTelephone();
        $this->password = $utilisateur === null? null : $utilisateur->getPassword();
        $this->confirmPassword = $utilisateur === null? null : $utilisateur->getConfirmPassword();
        $this->filiere = $utilisateur === null? null : $utilisateur->getFiliere();
        $this->niveau = $utilisateur === null? null : $utilisateur->getNiveau();
        $this->UE = $utilisateur === null? null : $utilisateur->getUE();
        $this->numero_cni = $utilisateur === null? null : $utilisateur->getNumeroCni();
        $this->poste = $utilisateur === null? null : $utilisateur->getPoste();
        $this->registrationToken = $utilisateur === null? null : $utilisateur->getRegistrationToken();
        $this->resetPasswordToken = $utilisateur === null? null : $utilisateur->getResetPasswordToken();
        $this->poste = $utilisateur === null? null : $utilisateur->getPoste();
        $this->isVerified = $utilisateur === null? null : $utilisateur->getIsVerified();
    }
}