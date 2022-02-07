<?php


namespace App\Http\Api\Controller\Profil\Settings;


use App\Application\Auth\Command\SettingCommand;
use App\Domain\Auth\Entity\Utilisateur;
use App\Infrastructure\Adapter\Validator\CheckParameter;
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
        $missing = CheckParameter::check($data, ['id', 'email']);
        if ($missing['count'] > 0){
            return $this->json([
                'response' => "Mauvaise requête, paramètre manquant ('"
                    . implode("', '", $missing['missing']). "')"
            ], 406);
        }
        $response = $command->updateEmail($data);
        return $this->json(["response" => $response], 200);
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
        $missing = CheckParameter::check($data, ['id','newPassword', 'confirmPassword']);
        if ($missing['count'] > 0){
            return $this->json(["response" => "Mauvaise requête, paramètre manquant ('"
                .implode("', '", $missing['missing'])."')"
            ], 406);
        }
        $response = CheckParameter::equalPassword($data['newPassword'], $data['confirmPassword']);
        if ($response){
            $response = $command->updatePassword($data);
            return $this->json(["response" => $response], 200);
        }
        return $this->json(["response" => "les mots de passe ne sont pas identique"],400);
    }

    /**
     * @Route("/profil/setting/email/items", name="api_profil_setting_email")
     * @param Request $request
     * @return JsonResponse
     */
    public function items(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $missing = CheckParameter::check($data, ['id']);
        if ($missing['count'] > 0){
            return $this->json(["response" => "Mauvaise requête, paramètre manquant ('"
                .implode(", ", $missing['missing'])."')"
            ], 406);
        }
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur = $repo->findOneBy(["id" => $data["id"]]);

        return $this->json(["response" => $utilisateur->getEmail()], 200);
    }

    /**
     * @Route("/test")
     * @param Request $request
     * @return JsonResponse
     */
    public function test(Request $request) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $required = ['id', 'test', 'email', 'contain'];
        $data = CheckParameter::check($data,$required);
        return $this->json($data);
    }
}