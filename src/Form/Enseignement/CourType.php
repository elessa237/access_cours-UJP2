<?php


namespace App\Form\Enseignement;


use App\Entity\Enseignement\Cour;
use App\Entity\Enseignement\UE;
use App\Entity\InfoEtudiant\Filiere;
use App\Entity\InfoEtudiant\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add("nom", TextType::class, [
                "label" => false,
                "required" => true,
                "attr" => [
                    'class' => 'form-control',
                ]
            ])
            ->add('filiere', EntityType::class, [
                "class" => Filiere::class,
                "label" => false,
                "multiple" => true,
                "attr" => [
                    "style" => "width: 100%",
                    "class" => "custom-select"
                ]
            ])
            ->add("niveau", EntityType::class, [
                "class" => Niveau::class,
                "label" => false,
                "required" => true,
                "attr" => [
                    "style" => "width: 100%",
                    "class" => "custom-select"
                ]
            ])
            ->add("UE", EntityType::class, [
                "class" => UE::class,
                "label" => false,
                "required" => true,
                "attr" => [
                    "style" => "width: 100%",
                    "class" => "custom-select"
                ]
            ])
            ->add("cour", FileType::class, [
                "label" => false,
                "required" => true,
                "attr" => [
                    "class" => "form-control",
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver
            ->setDefaults([
                'data_class' => Cour::class,
            ]);
    }
}