<?php


namespace App\Http\App\Controller\Admin\Enseignement;


use App\Application\Ue\Command\UeCommand;
use App\Application\Ue\Dto\UeDto;
use App\Domain\Ue\Entity\Ue;
use App\Domain\Ue\Repository\UeRepository;
use App\Http\Form\UniteEnseignementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UniteEnseignementController
 * @package App\Controller\Dashboard
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 */
class UniteEnseignementController extends AbstractController
{
    /**
     * @param Request $request
     * @param UeRepository $UeRepository
     * @param UeCommand $ueCommand
     * @return Response
     * @Route("/UniteEnseignement", name="unite_enseign")
     */
    public function UniteEnseignement(Request $request,UeRepository $UeRepository, UeCommand $ueCommand) : Response
    {

        $ueDto = new UeDto();
        $form = $this->createForm(UniteEnseignementType::class, $ueDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $ueCommand->create($ueDto);
            return $this->redirectToRoute('unite_enseign');
        }
        return $this->renderForm("admin/enseignement/ue/index.html.twig",[
            'form' => $form,
            'ues' => $UeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/delete/ue-{id}", name="delete_ue", methods={"POST"})
     * @param Request $request
     * @param Ue $Ue
     * @param UeCommand $ueCommand
     * @return Response
     */
    public function delete(Request $request, Ue $Ue,UeCommand $ueCommand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Ue->getId(), $request->request->get('_token'))) {
            $ueCommand->delete($Ue);
        }
        return $this->redirectToRoute('unite_enseign', [], Response::HTTP_SEE_OTHER);
    }
}