<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class EditSelfType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('avatarFile', 
        ImageType::class, [
            'label' => 'Avatar (facultatif)',
            'enable_remote' => false,
            'max_width' => 200,
            'max_height' => 200, 
            'aspect_ratios' => [],
            'cropper_options'=> [
                'aspectRatio'=> 1,  
                'viewMode' => 1,
                'minCropBoxWidth' => 120, 
                'minCropBoxHeight' => 120, 
            ],
            'preview_height' => 200, 
            'preview_width' => 200, 
            'upload_button_class' => 'btn w-75 ml-0 mt-1 btn-success',
            'save_button_class' => 'btn btn-success mx-0 w-25',
            'cancel_button_class' => 'btn btn-outline-secondary mx-0 w-25'      
        ])      

        ->add(
            'viewUsername', 
            TextType::class,
            [ 
                'label' => "Nom d'utilisateur",
                'constraints' => [
                    new Length(["min" => 5, "minMessage" => "Veuillez entrer un nom d'utilisateur entre 5 et 50 caractères", "max" => 50, "maxMessage" => "Veuillez entrer un nom d'utilisateur entre 5 et 50 caractères"])
                    ]
            ]
        )
        ->add(
            'email', 
            EmailType::class,
            [
                "label" => "Email",
                'invalid_message' => 'L\'adresse email n\'est pas valide',
                'constraints' => [
                   new Length(["max" => 100, "maxMessage" => "Veuillez entrer un email plus court"]),       
                ]
                                
            ]
        )
        ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            $form->getData()->setUsername($user['viewUsername']); 
            unset($user['viewUsername']);

        })
        ->add('Enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}