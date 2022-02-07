<?php

namespace App\Infrastructure\Adapter\Abstracts;

use App\Domain\Auth\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

abstract class AbstractCommand
{
    protected EntityManagerInterface $manager;
    protected RequestStack $requestStack;
    protected EventDispatcherInterface $dispatcher;
    private UserPasswordHasherInterface $hasher;

    public function __construct(
        EntityManagerInterface $manager,
        RequestStack $requestStack,
        EventDispatcherInterface $dispatcher,
        UserPasswordHasherInterface $hasher
    )
    {
        $this->manager = $manager;
        $this->requestStack = $requestStack;
        $this->dispatcher = $dispatcher;
        $this->hasher = $hasher;
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


    /**
     * @param Utilisateur $user
     * @param string $plainPassword
     * @return string
     */
    protected function hash(Utilisateur $user, string $plainPassword)
    {
       return $this->hasher->hashPassword($user, $plainPassword);
    }
}
