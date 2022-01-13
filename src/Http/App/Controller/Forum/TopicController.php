<?php


namespace App\Http\App\Controller\Forum;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Forum
 * @Route("/forum")
 */
class TopicController extends AbstractController
{
    /**
     * @return Response
     * @Route("/show", name="app_show_topic")
     */
    public function show() : Response
    {
        return $this->render("forum/topic/show.html.twig");
    }
}