<?php

namespace App\Form;

use App\Entity\Utilisateur\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationEnseignantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Prenom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Email'
                ]
            ])
            ->add('numeroTelephone', TelType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Contact'
                ]
            ])
            ->add('numero_cni', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Numero CNI'
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Mot de passe'
                ]
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control',
                    'placeholder' => 'Confirmé'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
