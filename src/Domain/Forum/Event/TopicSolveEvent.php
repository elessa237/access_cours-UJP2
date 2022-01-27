<?php


namespace App\Domain\Forum\Event;


use App\Domain\Forum\Entity\Topic;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Domain\Forum\Event
 */
class TopicSolveEvent
{

    private Topic $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * @return Topic
     */
    public function getTopic(): Topic
    {
        return $this->topic;
    }
}