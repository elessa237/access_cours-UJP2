<?php


namespace App\Http\App\Controller\Profil;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Repository\CourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Profil
 */
class ProfilController extends AbstractController
{
    /**
     * @Route("/profil", name="app_profil")
     * @param CourRepository $courRepository
     * @return Response
     */
    public function index(CourRepository $courRepository) : Response
    {
        /** @var Utilisateur $utilisateur */
        $utilisateur = $this->getUser();

        if (in_array("ROLE_ETUDIANT", $utilisateur->getRoles()))
        {
            $cour = $courRepository->findLast(5, $utilisateur->getNiveau(), $utilisateur->getFiliere());
        }elseif(in_array("ROLE_ENSEIGNANT", $utilisateur->getRoles())){
            $cour = $courRepository->findBy(
                ['professeur' => $utilisateur],
                ['publishedAt' => 'DESC'],
                5
            );
        }else{
            $cour  = $courRepository->findLast(5);
        }

        return $this->render("profil/index.html.twig", [
            "cours" => $cour,
        ]);
    }

}