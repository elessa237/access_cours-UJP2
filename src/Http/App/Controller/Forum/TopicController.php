<?php


namespace App\Http\App\Controller\Forum;

use App\Application\Forum\Command\MessageCommand;
use App\Application\Forum\Command\TopicCommand;
use App\Application\Forum\Dto\MessageDto;
use App\Application\Forum\Dto\TopicDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Forum\Entity\Message;
use App\Domain\Forum\Entity\Topic;
use App\Domain\Forum\Repository\MessageRepository;
use App\Http\Form\Forum\MessageType;
use App\Http\Form\Forum\TopicType;
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
     * @return Response
     */
    public function new(Request $request, TopicCommand $topicCommand, Topic $topic = null): Response
    {
        if ($topic == null) {
            $topicDto = new TopicDto(new Topic());
            $topicDto->content = $this->renderView("forum/placeholder/_placeholder.html.twig");

        } else {
            $topicDto = new TopicDto($topic);
            $topicDto->content = $topic->getContent();
        }

        $form = $this->createForm(TopicType::class, $topicDto);

        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Utilisateur $this->getUser() */
            ($topicDto->id == null) ?
                $topicCommand->create($topicDto, $this->getUser()):
                $topicCommand->update($topicDto, $this->getUser());

            return $this->redirectToRoute('app_forum');
        }

        return $this->render('forum/topic/set_topic.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @param Topic $topic
     * @param Request $request
     * @param MessageCommand $messageCommand
     * @param MessageRepository $messageRepository
     * @return Response
     * @Route("/show/topic/{id}", name="app_show_topic")
     */
    public function show(
        Topic $topic,
        Request $request,
        MessageCommand $messageCommand,
        MessageRepository $messageRepository
    ) : Response
    {
        $messageDto = new MessageDto(new Message());

        $form = $this->createForm(MessageType::class, $messageDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $messageDto->author = $this->getUser();
            $messageDto->topic = $topic;
            $messageCommand->new($messageDto);
            return $this->redirectToRoute("app_show_topic", ["id" => $topic->getId()]);
        }

        return $this->render("forum/topic/show.html.twig", [
            'topic' => $topic,
            'messages' => $messageRepository->findBy(["topic" => $topic]),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/topic-{id}", name="app_delete_topic")
     * @param Topic $topic
     * @param TopicCommand $topicCommand
     * @return Response
     */
    public function delete(Topic $topic, TopicCommand $topicCommand): Response
    {
        $topicCommand->delete($topic);
        return $this->redirectToRoute('app_forum');
    }
}