<?php


namespace App\Http\App\Controller\Profil;


use App\Domain\Auth\Entity\Utilisateur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Profil
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SettingController extends AbstractController
{

    /**
     * @Route("/profil/setting/{id}", name="app_profil_setting")
     * @param Utilisateur $user
     * @return Response
     */
    public function index(Utilisateur $user) : Response
    {
        return $this->render("profil/setting.html.twig", [
            "id" => $user->getId()
        ]);
    }

}