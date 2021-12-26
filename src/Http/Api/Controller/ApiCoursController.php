<?php


namespace App\Http\Api\Controller;


use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use App\Domain\Cour\Repository\CourRepository;
use App\Domain\Ue\Repository\UeRepository;
use JsonException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Api\Controller
 * @Route("/api")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class ApiCoursController extends AbstractController
{

    /**
     * @Route("/ue", methods={"GET"})
     * @param UeRepository $ueRepository
     * @return JsonResponse
     */
    public function AllUe(UeRepository $ueRepository): JsonResponse
    {
        /** @var Utilisateur $utilisateur */
        $utilisateur = $this->getUser();

        if (in_array("ROLE_ETUDIANT", $utilisateur->getRoles())) {
            $filiere = $utilisateur->getFiliere();
            $ues = $filiere->getUniteEnseignements();
            return $this->json(["ues"=>$ues],200, [], ['groups' => 'cour:read']);
        }else {
            return $this->json([
                "ues" => $ueRepository->findAll(),
            ], 200, [], ['groups' => 'cour:read']);
        }
    }

    /**
     * @Route("/cour/filter", methods={"POST"})
     * @param Request $request
     * @param CourRepository $courRepository
     * @return JsonResponse
     * @throws JsonException
     */
    public function filter(Request $request, CourRepository $courRepository) : JsonResponse
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        /** @var string $filter */
        $filter = $content["id"];

        strlen($filter) === 0 ?
            $cours = $this->helps():
            $cours = $courRepository->findAllCoursByFilter($filter) ;

        return $this->json($cours, 200, [], ['groups' => 'cour:read']);
    }

    /**
     * @return Cour[]
     */
    private function helps()
    {
        $courRepository = $this->getDoctrine()->getRepository(Cour::class);
        /** @var Utilisateur $utilisateur */
        $utilisateur = $this->getUser();

        $niveau = $utilisateur->getNiveau();
        $filiere = $utilisateur->getFiliere();

        if (in_array("ROLE_ETUDIANT", $utilisateur->getRoles())){
            return $courRepository->findAllByFiliereAndNiveau($niveau,$filiere);
        }else{
            return $courRepository->findAll();
        }
    }

}