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

        $utilisateur = $this->getUser($user->id);

        $utilisateur->setNom($user->nom);
        $utilisateur->setPrenom($user->prenom);
        $utilisateur->setNumeroTelephone($user->numero_telephone);
        $this->manager->flush();
        return ("Information modifier avec success");
    }

    public function updateEmail(UtilisateurDto $user)
    {
        $utilisateur = $this->getUser($user->id);
        $utilisateur->setEmail($user->email);
        $this->manager->flush();
        return ("Information modifier avec success");
    }

    public function updatePassword(array $data)
    {
        $user = $this->getUser($data['id']);
        $newPassword = $this->hash($user, $data['newPassword']);
        $user->setPassword($newPassword);
        $this->manager->flush();
        return ("mot de passe modifier avec success");
    }

    private function getUser($id) : Utilisateur
    {
        $repo = $this->manager->getRepository(Utilisateur::class);

        return $repo->findOneBy(["id" => $id]);
    }
}