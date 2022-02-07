<?php


namespace App\Http\Api\Controller\Profil\Settings;


use App\Application\Auth\Command\SettingCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Api\Controller\Profil\Settings
 * @Route("/api")
 */
class ApiEmailPasswordController extends AbstractController
{

    /**
     * @Route("/profil/setting/change/email", name="app_profil_setting_email")
     * @param Request $request
     * @param SettingCommand $command
     * @return JsonResponse
     */
    public function email(Request $request, SettingCommand $command): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);

        $id = $data["id"];
        /** @var Utilisateur $utilisateur */
        $utilisateur = $repo->findOneBy(["id" => $id]);

        $utilisateurDto = new UtilisateurDto($utilisateur);
        $utilisateurDto->id = $data["id"];
        $utilisateurDto->email = $data["email"];
        $response = $command->updateEmail($utilisateurDto);
        return $this->json($response, 200);
    }

    /**
     * @Route("/profil/setting/change/password", name="app_profil_setting_password")
     * @param Request $request
     * @param SettingCommand $command
     * @return JsonResponse
     */
    public function password(Request $request, SettingCommand $command) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $response = $this->checkPassword($data);
        if ($response){
            $response = $command->updatePassword($data);
            return $this->json($response, 200);
        }
        return $this->json("les mots de passe ne sont pas identique",400);
    }

    /**
     * @Route("/profil/setting/email/items", name="api_profil_setting_email")
     * @param Request $request
     * @return JsonResponse
     */
    public function items(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $id = $data["id"];
        $utilisateur = $repo->findOneBy(["id" => $id]);
        $email = [
          "email" => $utilisateur->getEmail(),
        ];
        return $this->json($email, 200);
    }

    private function checkPassword(array $data): bool {
        $newPassword = $data['newPassword'];
        $confirmPassword = $data['confirmPassword'];

        if ($newPassword === $confirmPassword)
        {
            return true;
        }

        return false;
    }
}