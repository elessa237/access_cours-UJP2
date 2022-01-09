<?php


namespace App\Http\App\Controller\Home;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\Home
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @IsGranted("ROLE_ETUDIANT")
 */
class HomeController extends AbstractController
{

    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function Index() : Response
    {
        return $this->render("home/index.html.twig");
    }
}
