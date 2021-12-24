<?php


namespace App\Http\App\Controller\Admin\InfoEtudiant;



use App\Application\Niveau\Command\NiveauCommand;
use App\Application\Niveau\Dto\NiveauDto;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Niveau\Repository\NiveauRepository;
use App\Http\Form\NiveauType;
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
    /**
     * @param NiveauRepository $niveauRepository
     * @param Request $request
     * @param NiveauCommand $niveauCommand
     * @return Response
     * @Route("/niveau", name="niveau")
     */
    public function niveau(NiveauRepository $niveauRepository,Request $request, NiveauCommand $niveauCommand) : Response
    {
        $niveauDto = new NiveauDto();
        $form = $this->createForm(NiveauType::class, $niveauDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
           $niveauCommand->create($niveauDto);
           return $this->redirectToRoute("niveau");
        }

        return $this->renderForm("admin/infoEtudiant/niveau/index.html.twig",[
            'form' => $form,
            'niveaux' => $niveauRepository->findAll(),
        ]);
    }

    /**
     * @Route("/niveau/update/{id}", name="update_niveau")
     * @Route("/niveau/create", name="create_niveau")
     * @param Request $request
     * @param NiveauCommand $niveauCommand
     * @param Niveau|null $niveau
     * @return Response
     */
    public function form(Request $request, NiveauCommand $niveauCommand, Niveau $niveau = null) : Response
    {
        $niveau === null ? $niveauDto = new NiveauDto() : $niveauDto = new NiveauDto($niveau);
        $form = $this->createForm(NiveauType::class, $niveauDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $niveauDto->id === null?
            $niveauCommand->create($niveauDto) :
            $niveauCommand->update($niveauDto);

            return $this->redirectToRoute("niveau");
        }
        return $this->render("admin/infoEtudiant/niveau/set_niveau.html.twig", [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @param Niveau $niveau
     * @param NiveauCommand $niveauCommand
     * @return Response
     * @Route("/delete/niveau-{id}", name="delete_niveau")
     */
    public function delete (Niveau $niveau, NiveauCommand $niveauCommand) : Response
    {
        $niveauCommand->delete($niveau);
        return $this->redirectToRoute("niveau");
    }
}