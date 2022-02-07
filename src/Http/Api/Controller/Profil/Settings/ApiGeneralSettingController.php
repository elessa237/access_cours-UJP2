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
 */
class ApiGeneralSettingController extends AbstractController
{
    /**
     * @Route("/api/profil/settings/generalSetting", name="api_general_setting", methods={"POST"})
     * @param Request $request
     * @param SettingCommand $command
     * @return JsonResponse
     */
    public function index(Request $request, SettingCommand $command) : JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $missing = CheckParameter::check($data, ['id', 'nom', 'tel', 'prenom']);

        if ($missing['count'] > 0){
            return $this->json(["response" => "Mauvaise requête, paramètre manquant ('"
                .implode(", ", $missing['missing'])."')"
            ], 406);
        }

        $response = $command->updateGeneralSetting($data);
        return $this->json(["response" => $response->message], $response->statut);
    }

    /**
     * @Route("/api/profil/generalSetting/items", name="api_general_setting_items")
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
        $utilisateur = $repo->findOneBy(["id" => $data['id']]);
        $user = [
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "tel" => $utilisateur->getNumeroTelephone()
        ];

        return $this->json(["response" => $user], 200);
    }
}