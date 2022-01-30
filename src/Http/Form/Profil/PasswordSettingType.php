<?php


namespace App\Http\Form\Profil;


use App\Application\Auth\Dto\UtilisateurDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Form\Profil
 */
class PasswordSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("oldPassword", PasswordType::class, [
            "label" => false,
            "required" => true,
            "mapped" => false,
            "attr" => [
                "class" => "form-control",
                "placeholder" => "mot de passe actuel"
            ]
        ])
            ->add("password", PasswordType::class, [
                "label" => false,
                "required" => true,
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Entrer le mot de passe"
                ]
            ])
            ->add("confirmPassword", PasswordType::class, [
                "label" => false,
                "required" => true,
                "attr" => [
                    "class" => "form-control",
                    "placeholder" => "Confirmer"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data_class" => UtilisateurDto::class
        ]);
    }

}