<?php


namespace App\Http\App\Controller\Admin\InfoEtudiant;



use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Filiere\Repository\FiliereRepository;
use App\Http\Form\FiliereType;
use App\Service\InfoEtudiant\FiliereService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FiliereController
 * @package App\Controller\Dashboard\InfoEtudiant
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 */
class FiliereController extends AbstractController
{
    private FiliereService $filiereService;
    public function __construct(FiliereService $filiereService)
    {
        $this->filiereService = $filiereService;
    }

    /**
     * @param FiliereRepository $filiereRepo
     * @param Request $request
     * @return Response
     * @Route("/filiere", name="filiere")
     */
    public function filiere(FiliereRepository $filiereRepo, Request $request): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->filiereService->create($filiere, $form);
            return $this->redirectToRoute("filiere");
        }

        return $this->renderForm("admin/infoEtudiant/filiere/index.html.twig", [
            'form' => $form,
            'filieres' => $filiereRepo->findAll()
        ]);
    }

    /**
     * @param Filiere $filiere
     * @param Request $request
     * @return Response
     * @Route("/delete/filiere-{id}", name="delete_filiere", methods={"POST"})
     */
    public function delete(Filiere $filiere, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $filiere->getId(), $request->request->get('_token')))
        {
            $this->filiereService->delete($filiere);
        }

        return $this->redirectToRoute("filiere");
    }
}