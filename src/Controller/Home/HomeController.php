<?php


namespace App\Controller\Home;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\Home
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function Index() : Response
    {
       return $this->render("home/index.html.twig", []);
    }
}