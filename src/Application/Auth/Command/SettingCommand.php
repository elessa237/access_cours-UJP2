<?php


namespace App\Application\Auth\Command;


use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class SettingCommand extends AbstractCommand
{

    /**
     * @param array $data
     * @return string
     */
    public function updateGeneralSetting(array $data) : string
    {

        $utilisateur = $this->getUser($data['id']);

        $utilisateur->setNom($data['nom']);
        $utilisateur->setPrenom($data['prenom']);
        $utilisateur->setNumeroTelephone($data['tel']);
        $this->manager->flush();
        return ("Information modifier avec success");
    }

    public function updateEmail(array $data)
    {
        $utilisateur = $this->getUser($data['id']);
        $utilisateur->setEmail($data['email']);
        $this->manager->flush();
        return ("Votre adresse email a bien été modifier");
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