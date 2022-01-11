<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class UtilisateurCommand
 * @package App\Application\Auth\Command
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class UtilisateurCommand
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function removeUser(Utilisateur $utilisateur) : void
    {
        $this->manager->remove($utilisateur);
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
