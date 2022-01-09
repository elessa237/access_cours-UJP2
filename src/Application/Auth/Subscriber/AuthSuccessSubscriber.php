<?php


namespace App\Application\Auth\Subscriber;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Auth\Event\AuthSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Subscriber
 */
class AuthSuccessSubscriber implements EventSubscriberInterface
{



    private SessionInterface $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            AuthSuccessEvent::class => 'onAuthSuccess'
        ];
    }

    public function onAuthSuccess(AuthSuccessEvent $event)
    {
        if (!$event->getUser() instanceof Utilisateur)
        {
            return;
        }
        $userFirstName = $event->getUser()->getNom();
        $userLastName = $event->getUser()->getPrenom();

        $this->session->getFlashBag()->add("success", "Bienvenue {$userLastName} {$userFirstName}");
    }
}