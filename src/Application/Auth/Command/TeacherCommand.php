<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class TeacherCommand extends AbstractCommand
{

    private TokenGeneratorInterface $generator;

    public function __construct(
        $manager,
        $requestStack,
        $dispatcher,
        $hasher, TokenGeneratorInterface $generator)
    {
        parent::__construct($manager, $requestStack, $dispatcher, $hasher);
        $this->generator = $generator;
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
                $this->hasher->hash(
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