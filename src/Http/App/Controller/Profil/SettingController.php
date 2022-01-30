<?php


namespace App\Http\App\Controller\Profil;


use App\Application\Auth\Command\SettingCommand;
use App\Application\Auth\Dto\UtilisateurDto;
use App\Domain\Auth\Entity\Utilisateur;
use App\Http\Form\Profil\EmailSettingType;
use App\Http\Form\Profil\GeneralSettingType;
use App\Http\Form\Profil\PasswordSettingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\App\Controller\Profil
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class SettingController extends AbstractController
{

    private SettingCommand $command;

    public function __construct(SettingCommand $command)
    {
        $this->command = $command;
    }

    /**
     * @Route("/profil/setting/{id}", name="app_profil_setting")
     * @param Utilisateur $user
     * @return Response
     */
    public function index(Utilisateur $user) : Response
    {
        return $this->render("profil/setting.html.twig", [
            "user" => $user
        ]);
    }

}