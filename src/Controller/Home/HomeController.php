<?php


namespace App\Controller\Home;

use App\Entity\Utilisateur\Utilisateur;
use App\Repository\Enseignement\CourRepository;
use App\Repository\Enseignement\UERepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller\Home
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @IsGranted("ROLE_ETUDIANT")
 */
class HomeController extends AbstractController
{
    /**
     * @param UERepository $ueRepo
     * @param CourRepository $courRepo
     * @return Response
     * @Route("/", name="home")
     */
    public function Index(UERepository $ueRepo,CourRepository $courRepo) : Response
    {

        /** @var Utilisateur $etudiant */
        $etudiant = $this->getUser();

        if (in_array("ROLE_ETUDIANT", $etudiant->getRoles()))
        {
            $filiere = $etudiant->getFiliere();
            $ues = $filiere->getUniteEnseignements();

            return $this->render("home/index.html.twig", [
                'ues' => $ues,
                'cours' => $courRepo->findAllByFiliere($filiere),
            ]);
        }else
        {
            return $this->render("home/index.html.twig", [
                "cours" => $courRepo->findAll(),
                "ues" => $ueRepo->findAll(),
            ]);
        }
    }
}