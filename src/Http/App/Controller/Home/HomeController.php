<?php


namespace App\Http\App\Controller\Home;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Repository\CourRepository;
use App\Domain\Ue\Repository\UeRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param UeRepository $ueRepo
     * @param CourRepository $courRepo
     * @param Request $request
     * @return Response
     * @Route("/", name="home")
     */
    public function Index(UeRepository $ueRepo,CourRepository $courRepo,Request $request) : Response
    {

        /** @var Utilisateur $etudiant */
        $etudiant = $this->getUser();

        $search = $request->get('search', '');
        $filter = $request->get('filter', '');
        $filter = $ueRepo->findOneBy(['nom' => $filter]);

        if (in_array("ROLE_ETUDIANT", $etudiant->getRoles()))
        {
            $filiere = $etudiant->getFiliere();
            $niveau = $etudiant->getNiveau();
            $ues = $niveau->getUEs();

            return $this->render("home/index.html.twig", [
                'ues' => $ues,
                'cours' => $courRepo->findAllByFiliereAndNiveau($niveau,$filiere, $search, $filter),
                'lastCours' => $courRepo->findLast(4,$niveau, $filiere)
            ]);
        }else
        {
            return $this->render("home/index.html.twig", [
                "cours" => $courRepo->findAll(),
                "lastCours"=>$courRepo->findLast(4),
                "ues" => $ueRepo->findAll(),
            ]);
        }
    }
}
