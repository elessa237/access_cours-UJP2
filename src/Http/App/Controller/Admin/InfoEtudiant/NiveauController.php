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
     * @param Niveau $niveau
     * @param Request $request
     * @param NiveauCommand $niveauCommand
     * @return Response
     * @Route("/delete/niveau-{id}", name="delete_niveau", methods={"POST"})
     */
    public function delete (Niveau $niveau, Request $request, NiveauCommand $niveauCommand) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$niveau->getId(), $request->request->get('_token')))
        {
            $niveauCommand->delete($niveau);
        }
        return $this->redirectToRoute("niveau");
    }
}