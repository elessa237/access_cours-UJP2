<?php


namespace App\Domain\Auth\Traits;


//use App\Domain\Auth\Entity\Utilisateur;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Auth\Traits
 */
trait UserSecurityTrait
{
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $registrationToken;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $resetPasswordToken;

    /**
     * @ORM\Column(type="boolean")
     */
    private bool $isVerified;

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
    /**
     * @return string
     */
    public function getRegistrationToken(): ?string
    {
        return $this->registrationToken;
    }

    /**
     * @param string $registrationToken
     * @return self
     */
    public function setRegistrationToken(string $registrationToken): self
    {
        $this->registrationToken = $registrationToken;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getResetPasswordToken(): ?string
    {
        return $this->resetPasswordToken;
    }

    /**
     * @param string|null $resetPasswordToken
     * @return self
     */
    public function setResetPasswordToken(?string $resetPasswordToken): self
    {
        $this->resetPasswordToken = $resetPasswordToken;

        return $this;
    }

    /**
     * @return bool
     */
    public function getIsVerified(): bool
    {
        return $this->isVerified;
    }

    /**
     * @param bool $isVerified
     * @return self
     */
    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }
}