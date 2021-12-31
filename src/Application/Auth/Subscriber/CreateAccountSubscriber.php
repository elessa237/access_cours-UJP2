<?php


namespace App\Application\Auth\Subscriber;

use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Auth\Event\CreateAccountEvent;
use App\Infrastructure\Mail\ConfirmationAccountEmail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Subscriber
 */
class CreateAccountSubscriber implements EventSubscriberInterface
{
    private EntityManagerInterface $em;
    private ConfirmationAccountEmail $email;

    public function __construct(EntityManagerInterface $em, ConfirmationAccountEmail $email)
    {
        $this->em = $em;
        $this->email = $email;
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            CreateAccountEvent::class => 'onCreateAccount'
        ];
    }

    public function onCreateAccount(CreateAccountEvent $event)
    {
        if (!$event->getStudent() instanceof Utilisateur){
            return;
        }
        $this->email->send($event->getStudent());
    }
}