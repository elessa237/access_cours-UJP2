<?php

namespace App\Http\App\Controller\RegAuth;


use App\Application\Auth\Command\StudentCommand;
use App\Application\Auth\Command\UtilisateurCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Http\Form\Utilisateur\RegistrationEtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register_etudiant", name="etudiant_register")
     * @param Request $request
     * @param StudentCommand $studentCommand
     * @return Response
     */
    public function register_etudiant(Request $request, StudentCommand $studentCommand): Response
    {
        $etudiantDto = new UtilisateurDto();
        $form = $this->createForm(RegistrationEtudiantType::class, $etudiantDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $studentCommand->createStudent($etudiantDto);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register_etudiant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/validate-email/{id}/{token}", name="validate_email")
     * @param Utilisateur $user
     * @param string $token
     * @param UtilisateurCommand $utilisateurCommand
     * @return Response
     */
    public function ValidateEmail(Utilisateur $user, string $token, UtilisateurCommand $utilisateurCommand) : Response
    {
        if ($user->getRegistrationToken() === null || $user->getRegistrationToken() !== $token) {
            throw new AccessDeniedException();
        }
        $userDto = new UtilisateurDto($user);
        $utilisateurCommand->activeAccount($userDto);

        return $this->redirectToRoute('app_login');
    }
}
