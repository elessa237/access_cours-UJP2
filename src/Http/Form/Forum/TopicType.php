<?php

namespace App\Http\Form\Forum;

use App\Application\Forum\Dto\TopicDto;
use App\Domain\Forum\Entity\Tag;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TopicType  extends AbstractType
{
   public function buildForm(FormBuilderInterface $builder, array $options)
   {
       $builder
            ->add('name', TextType::class, [
                'label' => false,
                'required' => true,
                "attr" => [
                    'label' => 'form-control'
                ]
            ])
            ->add('tag', EntityType::class, [
                'class' => Tag::class,
                'multiple' => true,
                "label" => false,
                "required" => true,
                "attr" => [
                    "style" => "width: 100%",
                    "class" => "custom-select",
                    'data-limit' => 3,
                ]
            ])
            ->add('content', CKEditorType::class, [
                'required' => true,
                'label' => false,
                'config_name' => "app_config",
            ]);
   }

   public function configureOptions(OptionsResolver $resolver)
   {
       $resolver->setDefaults([
           'data_class' => TopicDto::class
       ]);
   }
}
