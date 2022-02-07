<?php


namespace App\Application\Auth\Command;


use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Abstracts\AbstractCommand;
use App\Infrastructure\Adapter\Responses\ResponseApi;
use App\Infrastructure\Adapter\Validator\Validate;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Command
 */
class SettingCommand extends AbstractCommand
{

    /**
     * @param array $data
     * @return ResponseApi
     */
    public function updateGeneralSetting(array $data) : ResponseApi
    {
        if (Validate::notNull($data['nom'])){
            if (Validate::notNull($data['prenom']))
            {
                if (Validate::notNull($data['tel']))
                {
                    $utilisateur = $this->getUser($data['id']);

                    $utilisateur->setNom($data['nom']);
                    $utilisateur->setPrenom($data['prenom']);
                    $utilisateur->setNumeroTelephone($data['tel']);
                    $this->manager->flush();
                    return $this->response("Information modifier avec success");
                }
                return $this->response("Le numero ne dois pas être vide", 400);
            }
            return $this->response("Le prenom ne dois pas être vide", 400);
        }
        return $this->response("Le nom ne dois pas être vide", 400);
    }

    /**
     * @param array $data
     * @return ResponseApi
     */
    public function updateEmail(array $data) : ResponseApi
    {
        if (Validate::notNull($data['email'])){
            if (Validate::email($data['email'])){
                $utilisateur = $this->getUser($data['id']);
                $utilisateur->setEmail($data['email']);
                $this->manager->flush();
                return $this->response("Votre adresse email a bien été modifier");
            }
            return $this->response("L'adresse e-mail n'est pas valide", 400);
        }
       return $this->response("L'adresse e-mail ne doit pas être vide", 400);
    }

    /**
     * @param array $data
     * @return ResponseApi
     */
    public function updatePassword(array $data) : ResponseApi
    {
        if (Validate::notNull($data['newPassword'])){
            if (Validate::equalTo($data['newPassword'], $data['confirmPassword'])){
                if (Validate::password($data['newPassword'])){
                    $user = $this->getUser($data['id']);
                    $newPassword = $this->hash($user, $data['newPassword']);
                    $user->setPassword($newPassword);
                    $this->manager->flush();
                    return $this->response("mot de passe modifier avec success");
                }
                return $this->response("Le mot de passe doit avoir au minimum 8 caractères", 400);
            }
            return $this->response("Les mot de passe ne sont pas identique", 400);
        }
        return $this->response("Vous devez renseignez tout les champs", 400);
    }

    /**
     * @param $id
     * @return Utilisateur
     */
    private function getUser($id) : Utilisateur
    {
        $repo = $this->manager->getRepository(Utilisateur::class);

        return $repo->findOneBy(["id" => $id]);
    }

}