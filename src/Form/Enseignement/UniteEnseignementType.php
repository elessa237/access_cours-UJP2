<?php


namespace App\Form\Enseignement;


use App\Entity\Enseignement\UE;
use App\Entity\InfoEtudiant\Filiere;
use App\Entity\InfoEtudiant\Niveau;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UniteEnseignementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('niveau', EntityType::class, [
                'class' => Niveau::class,
                'label' => false,
                'multiple' => false,
                'attr' => [
                    "style" => "width: 100%",
                    'class' => 'custom-form',
                ]
            ])
            ->add("filiere", EntityType::class, [
                'class' => Filiere::class,
                'label' => false,
                'multiple' => true,
                'attr' => [
                    "style" => "width: 100%",
                    'class' => 'custom-form',
                ]
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
                'data_class' => UE::class,
            ]);
    }
}