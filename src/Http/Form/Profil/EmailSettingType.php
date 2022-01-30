<?php


namespace App\Http\Form\Profil;


use App\Application\Auth\Dto\UtilisateurDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Form\Profil
 */
class EmailSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("email", EmailType::class, [
            "label" => false,
            "required" => true,
            "attr"=>[
                "class" => "from-control",
                "placeholder" => "Entrer votre adresse Email"
            ]
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
           "data_class" => UtilisateurDto::class
       ]);
    }
}