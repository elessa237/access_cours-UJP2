<?php


namespace App\Controller\Admin\Utilisateur;


use App\Entity\Utilisateur\Utilisateur;
use App\Form\Utilisateur\RegistrationEnseignantType;
use App\Repository\Utilisateur\UtilisateurRepository;
use App\Service\UtilisateurService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @package App\Controller\Dashboard
 * @IsGranted("ROLE_ADMIN")
 * @Route("/admin/enseignant")
 */
class EnseignantController extends AbstractController
{
    private UtilisateurService $utilisateurService;

    public function __construct(UtilisateurService $utilisateurService){
        $this->utilisateurService = $utilisateurService;
    }

    /**
     * @param UtilisateurRepository $enseignantRepo
     * @param Request $request
     * @return Response
     * @Route("/", name="show_enseignant")
     */
    public function home (UtilisateurRepository $enseignantRepo,Request $request) : Response
    {
        $enseignant = new Utilisateur();
        $form = $this->createForm(RegistrationEnseignantType::class, $enseignant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->utilisateurService->createTeacher($enseignant, $form);
            $this->addFlash('success', "L'enseignant a bien ete ajouter");
            return $this->redirectToRoute("show_enseignant");

        }

        return $this->render('admin/Enseignant/index.html.twig', [
            'enseignants' => $enseignantRepo->findAllByPoste("ENSEIGNANT"),
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/delete/enseignant-{id}", name="delete_enseignant", methods={"POST"})
     * @param Request $request
     * @param Utilisateur $enseignant
     * @return Response
     */
    public function delete(Request $request, Utilisateur $enseignant): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
           $this->utilisateurService->removeTeacher($enseignant);
        }

        return $this->redirectToRoute('show_enseignant', [], Response::HTTP_SEE_OTHER);
    }
}