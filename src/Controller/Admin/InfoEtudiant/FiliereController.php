<?php


namespace App\Controller\Admin\InfoEtudiant;


use App\Entity\InfoEtudiant\Filiere;
use App\Form\InfoEtudiant\FiliereType;
use App\Repository\InfoEtudiant\FiliereRepository;
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
            $manager = $this->getDoctrine()->getManager();
            $filiere->setNom(strtoupper($form->get('nom')->getData()))
                    ->setAlias(strtoupper($form->get('alias')->getData()));

            $manager->persist($filiere);
            $manager->flush();

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
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($filiere);
            $manager->flush();
        }

        return $this->redirectToRoute("filiere");
    }
}