<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Auth\Event\CreateAccountEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class StudentCommand
{
    private EntityManagerInterface $manager;
    private UserPasswordHasherInterface $hasher;
    private TokenGeneratorInterface $generator;
    private EventDispatcherInterface $dispatcher;

    public function __construct
    (   EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher,
        TokenGeneratorInterface $generator,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->manager = $manager;
        $this->hasher = $hasher;
        $this->generator = $generator;
        $this->dispatcher = $dispatcher;
    }

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
            ->setRegistrationToken($this->generator->generateToken())
            ->setIsVerified(false)
            ->setPassword(
                $this->hasher->hashPassword(
                    $utilisateur,
                    $utilisateurDto->password
                )
            )
        ;

        $this->manager->persist($utilisateur);
        $this->manager->flush();

        $this->dispatcher->dispatch(new CreateAccountEvent($utilisateur));
    }

}