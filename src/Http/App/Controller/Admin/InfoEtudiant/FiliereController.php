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
     * @param Request $request
     * @param FiliereCommand $filiereCommand
     * @return Response
     * @Route("/filiere", name="filiere")
     */
    public function filiere(FiliereRepository $filiereRepo, Request $request, FiliereCommand $filiereCommand): Response
    {
        $filiereDto = new FiliereDto();
        $form = $this->createForm(FiliereType::class, $filiereDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $filiereCommand->create($filiereDto);
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
     * @param FiliereCommand $filiereCommand
     * @return Response
     * @Route("/delete/filiere-{id}", name="delete_filiere", methods={"POST"})
     */
    public function delete(Filiere $filiere, Request $request, FiliereCommand $filiereCommand) : Response
    {
        if ($this->isCsrfTokenValid('delete' . $filiere->getId(), $request->request->get('_token')))
        {
            $filiereCommand->delete($filiere);
        }

        return $this->redirectToRoute("filiere");
    }
}