<?php


namespace App\Http\Api\Controller\Profil\Settings;


use App\Application\Auth\Command\SettingCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use JsonException;
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
     * @throws JsonException
     */
    public function index(Request $request, SettingCommand $command) : JsonResponse
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $utilisateur = $repo->findOneBy(["id" => $content["id"]]);

        $utilisateurDto = new UtilisateurDto($utilisateur);

        $utilisateurDto->id = $content["id"];
        $utilisateurDto->nom = $content["nom"];
        $utilisateurDto->prenom = $content["prenom"];
        $utilisateurDto->numero_telephone = $content["tel"];

        $response = $command->updateGeneralSetting($utilisateurDto);

        return $this->json($response, 200);
    }

    /**
     * @Route("/api/profil/generalSetting/items", name="api_general_setting_items")
     * @param Request $request
     * @return JsonResponse
     */
    public function items(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $id = $content["id"];
        $utilisateur = $repo->findOneBy(["id" => $id]);
        $user = [
            "nom" => $utilisateur->getNom(),
            "prenom" => $utilisateur->getPrenom(),
            "tel" => $utilisateur->getNumeroTelephone()
        ];

        return $this->json($user, 200);
    }
}