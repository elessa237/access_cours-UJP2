<?php


namespace App\Http\App\Controller\Admin\Enseignement;



use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use App\Domain\Cour\Repository\CourRepository;
use App\Http\Form\CourType;
use App\Service\Enseignement\CourService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CourController
 * @package App\Controller\Admin\Enseignement
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/enseignant")
 */
class CourController extends AbstractController
{
    private CourService $courService;

    public function __construct(CourService $courService)
    {
        $this->courService = $courService;
    }

    /**
     * @param Request $request
     * @param CourRepository $courRepo
     * @return Response
     * @Route("/cour", name="gestion_cour")
     */
    public function cour(Request $request,CourRepository $courRepo): Response
    {
        $cour = new Cour();
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);

        /** @var Utilisateur $professeur */
        $professeur = $this->getUser();
        $cours = $courRepo->findBy(
            ['professeur' => $professeur],
            ['publishedAt' => 'DESC']
        );

        if ($form->isSubmitted() && $form->isValid()) {
            $this->courService->create($cour, $professeur);

            return $this->redirectToRoute("gestion_cour");
        }

        return $this->renderForm("/admin/enseignement/cour/index.html.twig", [
            "form" => $form,
            "cours" => $cours,
        ]);
    }

    /**
     * @param Request $request
     * @param Cour $cour
     * @return Response
     * @Route("/delete/cour-{id}", name="delete_cour", methods={"POST"})
     */
    public function delete(Request $request, Cour $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $this->courService->delete($cour);
        }

        return $this->redirectToRoute("gestion_cour");
    }
}