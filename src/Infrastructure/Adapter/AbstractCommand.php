<?php

namespace App\Infrastructure\Adapter;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

abstract class AbstractCommand
{
    protected EntityManagerInterface $manager;
    protected RequestStack $requestStack;

    public function __construct(EntityManagerInterface $manager, RequestStack $requestStack)
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
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
}
