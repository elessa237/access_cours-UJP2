<?php


namespace App\Http\Api\Controller;


use App\Application\Forum\Command\MessageCommand;
use JsonException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Api\Controller
 * @Route("/api")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ApiForumController extends AbstractController
{
    /**
     * @param Request $request
     * @param MessageCommand $messageCommand
     * @return JsonResponse
     * @throws JsonException
     * @Route("/solveMessage", name="app_forum_solve_message", methods={"POST"})
     */
    public function setSolve(Request $request, MessageCommand $messageCommand) : JsonResponse
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $messageId = $content["message"];
        $topicId = $content["topic"];
        $response = $messageCommand->accepted($messageId, $topicId);
        return $this->json([], 200);
    }
}