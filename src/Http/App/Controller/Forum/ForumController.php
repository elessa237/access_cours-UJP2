<?php


namespace App\Http\App\Controller\Forum;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Forum
 * @IsGranted("ROLE_ETUDIANT")
 */
class ForumController extends AbstractController
{
    /**
     * @return Response
     * @Route("/forum", name="app_forum")
     */
    public function index() : Response
    {
        return $this->render("forum/index.html.twig");
    }
}