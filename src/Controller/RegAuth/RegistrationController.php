<?php

namespace App\Controller\RegAuth;

use App\Entity\Utilisateur\Utilisateur;
use App\Form\Utilisateur\RegistrationEtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    private UserPasswordHasherInterface $hash;

    public function __construct(UserPasswordHasherInterface $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @Route("/register_etudiant", name="etudiant_register")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    public function register_etudiant(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etudinat = new Utilisateur();
        $form = $this->createForm(RegistrationEtudiantType::class, $etudinat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $etudinat->setRoles(["ROLE_ETUDIANT"])
                ->setPoste("ETUDIANT")
                ->setPassword(
            $this->hash->hashPassword(
                $etudinat,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($etudinat);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register_etudiant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
