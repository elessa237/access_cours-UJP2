<?php


namespace App\Http\App\Controller\Profil;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Profil
 */
class SettingController extends AbstractController
{
    /**
     * @Route("/profil/setting", name="app_profil_setting")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render("profil/setting.html.twig");
    }
}