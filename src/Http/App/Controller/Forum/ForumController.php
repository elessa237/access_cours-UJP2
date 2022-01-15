<?php


namespace App\Http\App\Controller\Forum;


use App\Domain\Forum\Repository\TagRepository;
use App\Domain\Forum\Repository\TopicRepository;
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
     * @param TopicRepository $topicRepository
     * @param TagRepository $tagRepository
     * @return Response
     * @Route("/forum", name="app_forum")
     */
    public function index(TopicRepository $topicRepository, TagRepository $tagRepository) : Response
    {

        return $this->render("forum/index.html.twig", [
            'topics' => $topicRepository->findAll(),
            'tags' => $tagRepository->findAll()
        ]);
    }
}