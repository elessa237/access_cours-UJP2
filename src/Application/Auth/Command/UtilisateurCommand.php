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
 * Class UtilisateurCommand
 * @package App\Application\Auth\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UtilisateurCommand
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

        /*$this->manager->persist($utilisateur);
        $this->manager->flush();*/

        $this->dispatcher->dispatch(new CreateAccountEvent($utilisateur));
    }

    public function createTeacher(UtilisateurDto $enseignantDto, TokenGeneratorInterface $generator) : void
    {
        $enseignant = new Utilisateur();

        $enseignant->setNom($enseignantDto->nom)
            ->setPrenom($enseignantDto->prenom)
            ->setEmail($enseignantDto->email)
            ->setNumeroTelephone($enseignantDto->numero_telephone)
            ->setNumeroCni($enseignantDto->numero_cni)
            ->setRoles(["ROLE_ENSEIGNANT"])
            ->setPoste("Enseignant")
            ->setIsVerified(false)
            ->setRegistrationToken($generator->generateToken())
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

    public function removeUser(Utilisateur $utilisateur) : void
    {
        $this->manager->remove($utilisateur);
        $this->manager->flush();
    }

    public function update(UtilisateurDto $enseignantDto)
    {
        $repo = $this->manager->getRepository(Utilisateur::class);

        $enseignant = $repo->findOneBy(["id" => $enseignantDto->id]);

        $enseignant->setNom($enseignantDto->nom)
            ->setPrenom($enseignantDto->prenom)
            ->setEmail($enseignantDto->email)
            ->setNumeroTelephone($enseignantDto->numero_telephone)
            ->setNumeroCni($enseignantDto->numero_cni);

        $this->manager->flush();
    }

    public function activeAccount(UtilisateurDto $user)
    {
        $repo = $this->manager->getRepository(Utilisateur::class);

        $utilisateur = $repo->findOneBy(["id" => $user->id]);

        $utilisateur->setIsVerified(true)
            ->setRegistrationToken(null);

        $this->manager->flush();
    }
}
