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
     * @return Response
     * @Route("/", name="show_enseignant")
     */
    public function home (UtilisateurRepository $enseignantRepo) : Response
    {


        return $this->render('admin/Enseignant/index.html.twig', [
            'enseignants' => $enseignantRepo->findAllByPoste("ENSEIGNANT"),
        ]);
    }

    /**
     * @Route("/enseignant/update/{id}", name="update_teacher")
     * @Route("/enseignant/create", name="create_teacher")
     * @param Request $request
     * @param UtilisateurCommand $utilisateurCommand
     * @param Utilisateur|null $utilisateur
     * @return Response
     */
    public function form(Request $request, UtilisateurCommand $utilisateurCommand, Utilisateur $utilisateur = null) : Response
    {
        $utilisateur === null ? $enseignantDto = new UtilisateurDto() : $enseignantDto = new UtilisateurDto($utilisateur);

        $form = $this->createForm(RegistrationEnseignantType::class, $enseignantDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enseignantDto->id === null ?
            $utilisateurCommand->createTeacher($enseignantDto) :
            $utilisateurCommand->update($enseignantDto);

            return $this->redirectToRoute("show_enseignant");

        }

        return $this->render("admin/enseignant/set_teacher.html.twig", [
           'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/enseignant-{id}", name="delete_teacher")
     * @param Utilisateur $enseignant
     * @param UtilisateurCommand $utilisateurCommand
     * @return Response
     */
    public function delete(Utilisateur $enseignant, UtilisateurCommand $utilisateurCommand): Response
    {
       $utilisateurCommand->removeUser($enseignant);
        return $this->redirectToRoute('show_enseignant', [], Response::HTTP_SEE_OTHER);
    }
}