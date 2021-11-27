<?php


namespace App\Controller\Admin\Enseignement;


use App\Entity\Enseignement\UE;
use App\Form\Enseignement\UniteEnseignementType;
use App\Repository\Enseignement\UERepository;
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
     * @param UERepository $UERepository
     * @return Response
     * @Route("/UniteEnseignement", name="unite_enseign")
     */
    public function UniteEnseignement(Request $request,UERepository $UERepository) : Response
    {
        $ue = new UE();
        $form = $this->createForm(UniteEnseignementType::class, $ue);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($ue);
            $manager->flush();

            $this->redirectToRoute('unite_enseign');
        }
        return $this->renderForm("admin/enseignement/ue/index.html.twig",[
            'form' => $form,
            'ues' => $UERepository->findAll(),
        ]);
    }

    /**
     * @Route("/delete/ue-{id}", name="delete_ue", methods={"POST"})
     * @param Request $request
     * @param UE $UE
     * @return Response
     */
    public function delete(Request $request, UE $UE): Response
    {
        if ($this->isCsrfTokenValid('delete'.$UE->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($UE);
            $manager->flush();
        }

        return $this->redirectToRoute('unite_enseign', [], Response::HTTP_SEE_OTHER);
    }
}