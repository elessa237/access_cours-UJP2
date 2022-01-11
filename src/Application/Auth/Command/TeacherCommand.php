<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class TeacherCommand
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
            ->setIsVerified(false)
            ->setRegistrationToken($this->generator->generateToken())
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

}