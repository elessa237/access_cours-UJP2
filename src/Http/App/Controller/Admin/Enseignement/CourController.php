<?php


namespace App\Http\App\Controller\Admin\Enseignement;



use App\Application\Cour\Command\CourCommand;
use App\Application\Cour\Dto\CourDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Domain\Cour\Entity\Cour;
use App\Domain\Cour\Repository\CourRepository;
use App\Http\Form\CourType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CourController
 * @package App\Controller\Admin\Enseignement
 * @author Maxime Elessa <elessamaxime@icloud.com>
 * @Route("/enseignant")
 */
class CourController extends AbstractController
{

    /**
     * @param Request $request
     * @param CourRepository $courRepo
     * @param CourCommand $courCommand
     * @return Response
     * @Route("/cour", name="gestion_cour")
     */
    public function create(Request $request,CourRepository $courRepo,CourCommand $courCommand): Response
    {
        $courDto = new CourDto();
        $form = $this->createForm(CourType::class, $courDto);
        $form->handleRequest($request);

        /** @var Utilisateur $professeur */
        $professeur = $this->getUser();

        $cours = $courRepo->findBy(
            ['professeur' => $professeur],
            ['publishedAt' => 'DESC']
        );

        if ($form->isSubmitted() && $form->isValid()) {

            $courCommand->create($courDto, $professeur);
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
     * @param CourCommand $courCommand
     * @return Response
     * @Route("/delete/cour-{id}", name="delete_cour", methods={"POST"})
     */
    public function delete(Request $request, Cour $cour, CourCommand $courCommand): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $courCommand->delete($cour);
        }

        return $this->redirectToRoute("gestion_cour");
    }
}