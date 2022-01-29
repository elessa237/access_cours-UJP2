<?php


namespace App\Http\App\Controller\Profil;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Profil
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     * @return Response
     */
    public function index() : Response
    {
        return $this->render("profil/index.html.twig");
    }
}