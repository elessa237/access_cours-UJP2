<?php


namespace App\Controller\Admin\Enseignement;


use App\Entity\Enseignement\Cour;
use App\Entity\Utilisateur\Utilisateur;
use App\Form\Enseignement\CourType;
use App\Repository\Enseignement\CourRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CourController
 * @package App\Controller\Admin\Enseignement
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/admin")
 */
class CourController extends AbstractController
{
    /**
     * @param Request $request
     * @param CourRepository $courRepo
     * @return Response
     * @Route("/cour", name="gestion_cour")
     */
    public function cour(Request $request,CourRepository $courRepo): Response
    {
        $cour = new Cour();
        $form = $this->createForm(CourType::class, $cour);
        $form->handleRequest($request);

        /** @var Utilisateur $professeur */
        $professeur = $this->getUser();
        $cours = $courRepo->findBy(
            ['professeur' => $professeur],
            ['publishedAt' => 'DESC']
        );

        if ($form->isSubmitted() && $form->isValid()) {

            $cour->setProfesseur($professeur)
                ->setPublishedAt(new DateTimeImmutable('now'));
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($cour);
            $manager->flush();

            return $this->redirectToRoute("gestion_cour");
        }

        return $this->renderForm("/admin/enseignement/cour/index.html.twig", [
            "form" => $form,
            "cours" => $cours,
        ]);
    }

    /**
     * @param Request $request
     * @param Cour $cour
     * @return Response
     * @Route("/delete/cour-{id}", name="delete_cour", methods={"POST"})
     */
    public function delete(Request $request, Cour $cour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($cour);
            $manager->flush();
        }

        return $this->redirectToRoute("gestion_cour");
    }
}