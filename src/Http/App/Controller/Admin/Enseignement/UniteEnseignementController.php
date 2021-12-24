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
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 * @package App\Controller\Dashboard
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
    public function UniteEnseignement(UeRepository $UeRepository): Response
    {
        return $this->renderForm("admin/enseignement/ue/index.html.twig", [
                'ues' => $UeRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/ue/update/{id}", name="update_ue")
     * @Route("/ue/create", name="create_ue")
     * @param Request $request
     * @param UeCommand $ueCommand
     * @param Ue|null $ue
     * @return Response
     */
    public function form(Request $request, UeCommand $ueCommand, Ue $ue = null): Response
    {
        $ue === null ? $ueDto = new UeDto() : $ueDto = new UeDto($ue);
        $form = $this->createForm(UniteEnseignementType::class, $ueDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ueDto->id === null ?
                $ueCommand->create($ueDto) :
                $ueCommand->update($ueDto);
            return $this->redirectToRoute('unite_enseign');
        }

        return $this->render("admin/enseignement/ue/set_ue.html.twig", [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/ue/delete/ue-{id}", name="delete_ue")
     * @param Ue $Ue
     * @param UeCommand $ueCommand
     * @return Response
     */
    public function delete(Ue $Ue, UeCommand $ueCommand): Response
    {
        $ueCommand->delete($Ue);
        return $this->redirectToRoute('unite_enseign', [], Response::HTTP_SEE_OTHER);
    }
}