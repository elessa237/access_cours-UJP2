<?php


namespace App\Controller\Admin\InfoEtudiant;


use App\Entity\InfoEtudiant\Niveau;
use App\Form\InfoEtudiant\NiveauType;
use App\Repository\InfoEtudiant\NiveauRepository;
use App\Service\InfoEtudiant\NiveauService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class NiveauController
 * @package App\Controller\Dashboard
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 */
class NiveauController extends AbstractController
{
    private NiveauService $niveauService;
    public function __construct(NiveauService $niveauService)
    {
        $this->niveauService = $niveauService;
    }

    /**
     * @param NiveauRepository $niveauRepository
     * @param Request $request
     * @return Response
     * @Route("/niveau", name="niveau")
     */
    public function niveau(NiveauRepository $niveauRepository,Request $request) : Response
    {
        $niveau = new Niveau();
        $form = $this->createForm(NiveauType::class, $niveau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           $this->niveauService->create($niveau);
           return $this->redirectToRoute("niveau");
        }

        return $this->renderForm("admin/infoEtudiant/niveau/index.html.twig",[
            'form' => $form,
            'niveaux' => $niveauRepository->findAll(),
        ]);
    }

    /**
     * @param Niveau $niveau
     * @param Request $request
     * @return Response
     * @Route("/delete/niveau-{id}", name="delete_niveau", methods={"POST"})
     */
    public function delete (Niveau $niveau, Request $request) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveau->getId(), $request->request->get('_token')))
        {
            $this->niveauService->delete($niveau);
        }
        return $this->redirectToRoute("niveau");
    }
}