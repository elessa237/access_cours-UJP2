<?php


namespace App\Http\Form\Profil;


use App\Application\Auth\Dto\UtilisateurDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Form\Profil
 */
class GeneralSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("nom", TextType::class, [
            "required" => true,
            "label" => false,
            "attr"=>[
                "class" => "form-control",
                "placeholder" => "Nom"
            ]
        ])
            ->add("prenom", TextType::class, [
                "required" => true,
                "label" => false,
                "attr"=>[
                    "class" => "form-control",
                    "placeholder" => "Prenom"
                ]
            ])
            ->add("numero_telephone", TextType::class, [
                "required" => true,
                "label" => false,
                "attr"=>[
                    "class" => "form-control",
                    "placeholder" => "Numero de telephone"
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