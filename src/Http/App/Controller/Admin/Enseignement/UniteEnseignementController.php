<?php


namespace App\Http\App\Controller\Admin\Enseignement;


use App\Domain\Ue\Entity\Ue;
use App\Domain\Ue\Repository\UeRepository;
use App\Http\Form\UniteEnseignementType;
use App\Service\Enseignement\UeService;
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
    private UeService $UeService;

    public function __construct(UeService $UeService)
    {
        $this->UeService = $UeService;
    }

    /**
     * @param Request $request
     * @param UeRepository $UeRepository
     * @return Response
     * @Route("/UniteEnseignement", name="unite_enseign")
     */
    public function UniteEnseignement(Request $request,UeRepository $UeRepository) : Response
    {
        $ue = new Ue();
        $form = $this->createForm(UniteEnseignementType::class, $ue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->UeService->create($ue);
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
     * @return Response
     */
    public function delete(Request $request, Ue $Ue): Response
    {
        if ($this->isCsrfTokenValid('delete'.$Ue->getId(), $request->request->get('_token'))) {
            $this->UeService->delete($Ue);
        }
        return $this->redirectToRoute('unite_enseign', [], Response::HTTP_SEE_OTHER);
    }
}