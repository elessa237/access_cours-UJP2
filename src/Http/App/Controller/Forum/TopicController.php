<?php


namespace App\Http\App\Controller\Forum;

use App\Application\Forum\Command\TopicCommand;
use App\Application\Forum\Dto\TopicDto;
use App\Domain\Forum\Entity\Topic;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @param TopicCommand $topicCommand
     * @param Topic|null $topic
     * @Route("/update/topic-{id}", name="app_update_topic")
     * @Route("/new/topic", name="app_create_topic")
     */
    public function new(Request $request, TopicCommand $topicCommand, Topic $topic = null): Response
    {
        $topic == null ? 
            $topicDto = new TopicDto(new Topic()):
            $topicDto = new TopicDto($topic);

        $topic == null ?
        $topicDto->content = $this->renderView("forum/placeholder/_placeholder.html.twig") : 
        $topicDto->content = $topic->getContent();

        $form = $this->createForm(TopicDto::class, $topicDto);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 

            $topicDto->id == null ? 
            $topicCommand->create($topicDto, $this->getUser()):$topicCommand->update($topicDto, $this->getUser());

            return $this->redirectToRoute('app_forum');
        }

        return $this->render('forum/topic/set_topic.html.twig', []);
    }


    /**
     * @return Response
     * @Route("/show", name="app_show_topic")
     */
    public function show() : Response
    {
        return $this->render("forum/topic/show.html.twig");
    }

    /**
     * @Route("/delete/topic-{id}", name="app_delete_topic")
     */
    public function delete(Topic $topic, TopicCommand $topicCommand): Response
    {
        $topicCommand->delete($topic);
        return $this->redirectToRoute('app_forum');
    }
}