<?php


namespace App\Application\Auth\Subscriber;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Auth\Event\AuthSuccessEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Application\Auth\Subscriber
 */
class AuthSuccessSubscriber implements EventSubscriberInterface
{
    
    private RequestStack $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
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
        $session = $this->requestStack->getSession();
        $hour = date('H');
        if ($hour>= 5 && $hour<12)
            $session->getFlashBag()->add("success", "Bonjour {$userLastName} {$userFirstName}");
        elseif ($hour>=12 && $hour<17)
            $session->getFlashBag()->add("success", "Hey c'est chouette que tu sois là {$userLastName}");
        elseif ($hour>=17 && $hour<00)
            $session->getFlashBag()->add("success", "Bonsoir {$userLastName} {$userFirstName}");
        elseif ($hour>=00 && $hour<5)
            $session->getFlashBag()->add("warning", "tu devrais être au lit tu est un titan {$userLastName}");
    }
}