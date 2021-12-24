<?php

namespace App\Http\App\Controller\Admin;


use App\Domain\Auth\Repository\UtilisateurRepository;
use App\Domain\Cour\Repository\CourRepository;
use App\Domain\Filiere\Repository\FiliereRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Dashboard
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @param UtilisateurRepository $utilisateurRepo
     * @param FiliereRepository $filiereRepo
     * @param CourRepository $coursRepo
     * @return Response
     */
    public function index(UtilisateurRepository $utilisateurRepo, FiliereRepository $filiereRepo, CourRepository $coursRepo): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig', [
            "cours" => $coursRepo->findAll(),
            "enseignants" => $utilisateurRepo->findAllByPoste("ENSEIGNANT"),
            "etudiants" => $utilisateurRepo->findAllByPoste("ETUDIANT"),
            "filieres" => $filiereRepo->findAll(),
        ]);
    }
}
