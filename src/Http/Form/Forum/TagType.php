<?php

namespace App\Http\Form\Forum;

use App\Application\Forum\Dto\TagDto;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @package App\Http\Form\Forum
 * @author Elessa Maxime <elessamaxime@icloud.com>
 */
class TagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
            "label" => false,
            "required" => true,
            "attr" => [
                'class' => 'form-control',
            ]
        ])
            ->add('color', ColorType::class,[
            "label" => false,
            "required" => true,
            "attr" => [
                'class' => 'form-control',
            ]
        ])
            ->add('description', CKEditorType::class, [
            "label" => false,
            "required" => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TagDto::class
        ]);
    }
}
