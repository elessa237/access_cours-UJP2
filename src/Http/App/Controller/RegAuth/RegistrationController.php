<?php

namespace App\Http\App\Controller\RegAuth;


use App\Application\Auth\Command\UtilisateurCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Http\Form\Utilisateur\RegistrationEtudiantType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{

    /**
     * @Route("/register_etudiant", name="etudiant_register")
     * @param Request $request
     * @param UtilisateurCommand $utilisateurCommand
     * @return Response
     */
    public function register_etudiant(Request $request, UtilisateurCommand $utilisateurCommand): Response
    {
        $etudiantDto = new UtilisateurDto();
        $form = $this->createForm(RegistrationEtudiantType::class, $etudiantDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $utilisateurCommand->createStudent($etudiantDto);
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register_etudiant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
