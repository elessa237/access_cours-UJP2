<?php


namespace App\Http\Form\Forum;


use App\Application\Forum\Dto\MessageDto;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Elessa Maxime <elessamaxime@icloud.com>
 * @package App\Http\Form\Forum
 */
class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("content", CKEditorType::class, [
            "required" => true,
            "label" => false,
            "config_name" => "app_config"
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
                "data_class" => MessageDto::class
            ]);
    }
}