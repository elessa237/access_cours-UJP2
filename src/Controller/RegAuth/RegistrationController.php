<?php

namespace App\Controller\RegAuth;

use App\Entity\Utilisateur\Utilisateur;
use App\Form\RegistrationEnseignantType;
use App\Form\RegistrationEtudiantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use \Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
                ->setPassword(
            $this->hash->hashPassword(
                $etudinat,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($etudinat);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register_etudiant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register_enseignant", name="enseignant_register")
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @return Response
     */
    //TODO : décommenter l'anotation @isGranted("ROLE_ADMIN")

    public function register_enseignat(Request $request, EntityManagerInterface $entityManager): Response
    {

        $Enseignant = new Utilisateur();
        $form = $this->createForm(RegistrationEnseignantType::class, $Enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $Enseignant->setRoles(["ROLE_ENSEIGNANT"])
                ->setPassword(
                $this->hash->hashPassword(
                    $Enseignant,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($Enseignant);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('registration/register_enseignant.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
