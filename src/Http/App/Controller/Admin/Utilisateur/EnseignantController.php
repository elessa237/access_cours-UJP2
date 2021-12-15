<?php


namespace App\Http\App\Controller\Admin\Utilisateur;


use App\Application\Auth\Command\UtilisateurCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Auth\Repository\UtilisateurRepository;
use App\Http\Form\Utilisateur\RegistrationEnseignantType;
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

    /**
     * @param UtilisateurRepository $enseignantRepo
     * @param Request $request
     * @param UtilisateurCommand $utilisateurCommand
     * @return Response
     * @Route("/", name="show_enseignant")
     */
    public function home (UtilisateurRepository $enseignantRepo,Request $request, UtilisateurCommand $utilisateurCommand) : Response
    {
        $enseignantDto = new UtilisateurDto();
        $form = $this->createForm(RegistrationEnseignantType::class, $enseignantDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $utilisateurCommand->createTeacher($enseignantDto);
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
     * @param UtilisateurCommand $utilisateurCommand
     * @return Response
     */
    public function delete(Request $request, Utilisateur $enseignant, UtilisateurCommand $utilisateurCommand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enseignant->getId(), $request->request->get('_token'))) {
           $utilisateurCommand->removeUser($enseignant);
        }

        return $this->redirectToRoute('show_enseignant', [], Response::HTTP_SEE_OTHER);
    }
}