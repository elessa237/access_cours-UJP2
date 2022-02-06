<?php


namespace App\Application\Auth\Command;


use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class SettingCommand extends AbstractCommand
{

    /**
     * @param UtilisateurDto $user
     * @return string
     */
    public function updateGeneralSetting(UtilisateurDto $user) : string
    {

        $utilisateur = $this->getUser($user);

        $utilisateur->setNom($user->nom);
        $utilisateur->setPrenom($user->prenom);
        $utilisateur->setNumeroTelephone($user->numero_telephone);
        $this->manager->flush();
        return ("Votre compte a bien été mis à jour");
    }

    public function updateEmail(UtilisateurDto $user)
    {
        $utilisateur = $this->getUser($user);
        $utilisateur->setEmail($user->email);
        $this->manager->flush();
    }

    public function updatePassword(UtilisateurDto $user)
    {

    }

    private function getUser(UtilisateurDto $user) : Utilisateur
    {
        $repo = $this->manager->getRepository(Utilisateur::class);

        return $repo->findOneBy(["id" => $user->id]);
    }
}