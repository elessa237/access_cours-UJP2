<?php

namespace App\Infrastructure\Adapter\Abstracts;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractCommand
{
    protected EntityManagerInterface $manager;
    protected RequestStack $requestStack;
    protected EventDispatcherInterface $dispatcher;

    public function __construct(
        EntityManagerInterface $manager,
        RequestStack $requestStack,
        EventDispatcherInterface $dispatcher
    )
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->dispatcher = $dispatcher;
    }


    protected function add(
        string $type,
        string $message,
        $data = null
    ): void {

        if ($data) {
            $this->manager->persist($data);
        }

        $this->manager->flush();

        $session = $this->requestStack->getSession();
        $session->getFlashBag()->add($type, $message);
    }

    protected function dispatch(Object $event)
    {
        $this->dispatcher->dispatch($event);
    }
}
