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
     * @param CourRepository $courRepo
     * @return Response
     * @Route("/cour", name="gestion_cour")
     */
    public function create(CourRepository $courRepo): Response
    {
        /** @var Utilisateur $professeur */
        $professeur = $this->getUser();

        $cours = $courRepo->findBy(
            ['professeur' => $professeur],
            ['publishedAt' => 'DESC']
        );

        return $this->render("/admin/enseignement/cour/index.html.twig", [
            "cours" => $cours,
        ]);
    }

    /**
     * @Route("/cour/new", name="create_cour")
     * @Route("/cour/update/cour-{id}", name="update_cour")
     * @param Cour $cour|null
     * @param Request $request
     * @param CourCommand $courCommand
     * @return Response
     */
    public function form(Request $request, CourCommand $courCommand, Cour $cour = null) : Response
    {
        $cour === null? $courDto = new CourDto() : $courDto = new CourDto($cour);

        $form = $this->createForm(CourType::class, $courDto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            if($courDto->id === null){
                $courDto->professeur = $this->getUser();
                $courCommand->create($courDto);
            }else{
                $courCommand->update($courDto);
            }

            return $this->redirectToRoute("gestion_cour");
        }

        return $this->render("admin/enseignement/cour/set_cour.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param Cour $cour
     * @param CourCommand $courCommand
     * @return Response
     * @Route("/delete/cour-{id}", name="delete_cour")
     */
    public function delete(Cour $cour, CourCommand $courCommand): Response
    {
        $courCommand->delete($cour);
        return $this->redirectToRoute("gestion_cour");
    }
}