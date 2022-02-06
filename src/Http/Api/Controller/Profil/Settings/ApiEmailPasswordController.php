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
 */
class ApiEmailPasswordController extends AbstractController
{
    /**
     * @Route("/api/profil/setting/change/email", name="app_profil_setting_email")
     * @param Request $request
     * @param SettingCommand $command
     * @return JsonResponse
     */
    public function email(Request $request, SettingCommand $command): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);

        $id = $content["id"];
        /** @var Utilisateur $utilisateur */
        $utilisateur = $repo->findOneBy(["id" => $id]);

        $utilisateurDto = new UtilisateurDto($utilisateur);
        $utilisateurDto->id = $content["id"];
        $utilisateurDto->email = $content["email"];
        $response = $command->updateEmail($utilisateurDto);
        return $this->json($response, 200);
    }

    /**
     * @Route("/api/profil/setting/email/items", name="api_profil_setting_email")
     * @param Request $request
     * @return JsonResponse
     */
    public function items(Request $request): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        $repo = $this->getDoctrine()->getRepository(Utilisateur::class);
        $id = $content["id"];
        $utilisateur = $repo->findOneBy(["id" => $id]);
        $email = [
          "email" => $utilisateur->getEmail(),
        ];
        return $this->json($email, 200);
    }
}