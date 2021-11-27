<?php

namespace App\Controller\Admin;

use App\Repository\InfoEtudiant\FiliereRepository;
use App\Repository\Utilisateur\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\Dashboard
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="dashboard")
     * @param UtilisateurRepository $utilisateurRepo
     * @return Response
     */
    public function index(UtilisateurRepository $utilisateurRepo, FiliereRepository $filiereRepo): Response
    {
        return $this->render('admin/dashboard/dashboard.html.twig', [
            "enseignants" => $utilisateurRepo->findAllByPoste("ENSEIGNANT"),
            "etudiants" => $utilisateurRepo->findAllByPoste("ETUDIANT"),
            "filieres" => $filiereRepo->findAll(),
        ]);
    }
}
