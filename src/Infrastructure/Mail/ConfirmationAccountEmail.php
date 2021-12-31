<?php


namespace App\Infrastructure\Mail;


use App\Domain\Auth\Entity\Utilisateur;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Infrastructure\Mail
 */
class ConfirmationAccountEmail
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param Utilisateur $user
     * @throws TransportExceptionInterface
     */
    public function send(Utilisateur $user): void
    {
        $email = (new TemplatedEmail())
            ->from('noreply@gmail.com')
            ->to(new Address($user->getEmail()))
            ->subject("confirmer votre inscription sur la plateforme Ujp2")
            ->htmlTemplate("email/Auth/confirmation.html.twig")
            ->context([
                "user" => $user
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $mailException) {
            throw $mailException;
        }
    }
}