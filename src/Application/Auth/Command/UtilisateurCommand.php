<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UtilisateurCommand
 * @package App\Application\Auth\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UtilisateurCommand
{
    private EntityManagerInterface $manager;
    private UserPasswordHasherInterface $hasher;

    public function __construct(EntityManagerInterface $manager, UserPasswordHasherInterface $hasher)
    {
        $this->manager = $manager;
        $this->hasher = $hasher;
    }

    /**
     * @param UtilisateurDto $utilisateurDto
     * @return void
     */
    public function createStudent(UtilisateurDto $utilisateurDto) : void
    {
        $utilisateur = new Utilisateur();

        $utilisateur->setNom($utilisateurDto->nom)
            ->setPrenom($utilisateurDto->prenom)
            ->setEmail($utilisateurDto->email)
            ->setNumeroTelephone($utilisateurDto->numero_telephone)
            ->setFiliere($utilisateurDto->filiere)
            ->setNiveau($utilisateurDto->niveau)
            ->setRoles(["ROLE_ETUDIANT"])
            ->setPassword(
                $this->hasher->hashPassword(
                    $utilisateur,
                    $utilisateurDto->password
                )
            )
        ;

        $this->manager->persist($utilisateur);
        $this->manager->flush();
    }

    /**
     * @param UtilisateurDto $enseignantDto
     * @return void
     */
    public function createTeacher(UtilisateurDto $enseignantDto) : void
    {
        $enseignant = new Utilisateur();

        $enseignant->setNom($enseignantDto->nom)
            ->setPrenom($enseignantDto->prenom)
            ->setEmail($enseignantDto->email)
            ->setNumeroTelephone($enseignantDto->numero_telephone)
            ->setNumeroCni($enseignantDto->numero_cni)
            ->setRoles(["ROLE_ENSEIGNANT"])
            ->setPoste("Enseignant")
            ->setPassword(
                $this->hasher->hashPassword(
                    $enseignant,
                    $enseignantDto->password
                )
            )
        ;

        $this->manager->persist($enseignant);
        $this->manager->flush();
    }

    /**
     * @param Utilisateur $utilisateur
     * @return void
     */
    public function removeUser(Utilisateur $utilisateur) : void
    {
        $this->manager->remove($utilisateur);
        $this->manager->flush();
    }
}