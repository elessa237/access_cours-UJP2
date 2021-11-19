<?php

namespace App\Form;

use App\Entity\InfoEtudiant\Filiere;
use App\Entity\InfoEtudiant\Niveau;
use App\Entity\Utilisateur\Etudiant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Prenom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Email'
                ]
            ])
            ->add('numeroTelephone', TelType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Contact'
                ]
            ])
            ->add('filiere', EntityType::class, [
                'class' => Filiere::class,
                'multiple' => false,
                'label' => false,
                'attr' => [
                    'class'=> 'form-select form-select-xl'
                ]
            ])
            ->add('niveau', EntityType::class, [
                'class' => Niveau::class,
                'multiple' => false,
                'label' => false,
                'attr' => [
                    'class'=> 'form-select form-select-xl'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Mot de passe'
                ]
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-xl',
                    'placeholder' => 'Confirmé'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
