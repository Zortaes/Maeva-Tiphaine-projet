<?php


namespace App\Form\Type;

use App\Entity\Feedback;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FeedbackType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('comment',
        TextareaType::class,
        [
            "label" => false,
            "attr" => array('placeholder' => "Ajouter un commentaire")
        ])
        ->add("Poster", SubmitType::class); 

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class' => Feedback::class,
        ]);

    }
}