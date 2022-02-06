<?php


namespace App\Http\Api\Controller\Profil\Settings;


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
    public function index(): JsonResponse
    {
        return $this->json([], 200);
    }

    /**
     * @Route("/api/profil/email/items", name="api_profil_email")
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