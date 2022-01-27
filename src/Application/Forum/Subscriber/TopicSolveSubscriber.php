<?php


namespace App\Application\Forum\Subscriber;


use App\Domain\Forum\Entity\Topic;
use App\Domain\Forum\Event\TopicSolveEvent;
use App\Infrastructure\Adapter\AbstractCommand;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Forum\Suscriber
 */
class TopicSolveSubscriber extends AbstractCommand implements EventSubscriberInterface
{

    /**
     * @return array
     */
    public static function getSubscribedEvents() : array
    {
        return [
            TopicSolveEvent::class => "onTopicSolve"
        ];
    }

    /**
     * @param TopicSolveEvent $event
     * @return void
     */
    public function onTopicSolve(TopicSolveEvent $event) : void
    {

        if (!$event->getTopic() instanceof Topic)
        {
            return;
        }
        $topic = $event->getTopic();
        $topic->setSolved(true);
        $this->manager->flush();
    }
}