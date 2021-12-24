<?php


namespace App\Http\App\Controller\Admin\InfoEtudiant;



use App\Application\Filiere\Command\FiliereCommand;
use App\Application\Filiere\Dto\FiliereDto;
use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Filiere\Repository\FiliereRepository;
use App\Http\Form\FiliereType;
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
     * @return Response
     * @Route("/filiere", name="filiere")
     */
    public function filiere(FiliereRepository $filiereRepo): Response
    {
        return $this->render("admin/infoEtudiant/filiere/index.html.twig", [
            'filieres' => $filiereRepo->findAll()
        ]);
    }

    /**
     * @Route("/filiere/update/{id}", name="update_filiere")
     * @Route("/filiere/create", name="create_filiere")
     * @param Request $request
     * @param FiliereCommand $filiereCommand
     * @param Filiere $filiere
     * @return Response
     */
    public function form(Request $request, FiliereCommand $filiereCommand, Filiere $filiere = null) : Response
    {
        $filiere === null ? $filiereDto = new FiliereDto() : $filiereDto = new FiliereDto($filiere);
        $form = $this->createForm(FiliereType::class, $filiereDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filiereDto->id === null ?
            $filiereCommand->create($filiereDto) :
            $filiereCommand->update($filiereDto);

            return $this->redirectToRoute("filiere");
        }

        return $this->render("admin/infoEtudiant/filiere/set_filiere.html.twig",[
            "form"=>$form->createView(),
        ]);
    }


    /**
     * @param Filiere $filiere
     * @param FiliereCommand $filiereCommand
     * @return Response
     * @Route("/delete/filiere-{id}", name="delete_filiere")
     */
    public function delete(Filiere $filiere, FiliereCommand $filiereCommand) : Response
    {
        $filiereCommand->delete($filiere);
        return $this->redirectToRoute("filiere");
    }
}