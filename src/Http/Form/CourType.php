<?php


namespace App\Http\Form;


use App\Application\Cour\Dto\CourDto;
use App\Domain\Filiere\Entity\Filiere;
use App\Domain\Niveau\Entity\Niveau;
use App\Domain\Ue\Entity\Ue;
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
            ->add('filieres', EntityType::class, [
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
                "class" => Ue::class,
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
                'data_class' => CourDto::class,
            ]);
    }
}