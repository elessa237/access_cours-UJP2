<?php


namespace App\Http\Api\Controller;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Repository\CourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Api\Controller
 * @Route("/api")
 */
class ApiCoursController extends AbstractController
{
    /**
     * @Route("/cour/{id}", methods={"GET"})
     * @param CourRepository $courRepository
     * @param Utilisateur $utilisateur
     * @return JsonResponse
     */
    public function index(CourRepository $courRepository, Utilisateur $utilisateur) : JsonResponse
    {

        if (in_array("ROLE_ETUDIANT", $utilisateur->getRoles())) {
            $filiere = $utilisateur->getFiliere();
            $niveau = $utilisateur->getNiveau();
            $cour = $courRepository->findAllByFiliereAndNiveau($niveau,$filiere);
            return $this->json($cour, 200, [], ['groups' => 'cour:read']);
        }else {
            $cour = $courRepository->findAll();
            return $this->json($cour, 200, [], ['groups' => 'cour:read']);
        }
        /*$cour = $courRepository->findAll();
        return $this->json($cour, 200, [], ['groups' => 'cour:read']);*/
    }

}