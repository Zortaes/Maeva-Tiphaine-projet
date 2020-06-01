<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Presta\ImageBundle\Form\Type\ImageType; 
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add(
            'username', 
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
        ->add(
            'plain_password', 
            RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'mapped' => false,
                'options' => [
                    'attr' => 
                    ['class' => 'password-field']
                ],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Confirmation de mot de passe'
                ],
                'constraints' => [
                new NotBlank(),
                new Length(["min" => 8, "minMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères", "max" => 16, "maxMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères"])
                ]
            ]
        )
        ->add('avatarFile', 
        ImageType::class, [
            'label' => 'Avatar (facultatif)',
            'enable_remote' => false,
            'max_width' => 200,
            'max_height' => 200, 
            'aspect_ratios' => [],
            'cropper_options'=> [
                'aspectRatio'=>1,
            ],
            'preview_height' => 200, 
            'preview_width' => 200, 
            'upload_button_class' => 'btn w-75 ml-0 mt-1 btn-success',
            'save_button_class' => 'btn btn-success mx-0 w-25',
            'cancel_button_class' => 'btn btn-outline-secondary mx-0 w-25'
            
        ])     
        ->add('recaptcha', EWZRecaptchaType::class, array(
            'attr'        => array(
                'options' => array(
                    'theme' => 'light',
                    'type'  => 'image',
                    'size'  => 'normal'
                )
            ),
            'mapped'      => false,
            'constraints' => array(
                new RecaptchaTrue()
            )
        ))
        ->add(
            'condition', 
            CheckboxType::class,
            [
                'mapped' => false,
                'required' => true, 
                'label' => "J'accepte les conditions générales d'utilisations", 
                'help' => 'En cochant cette case, vous reconnaissez avoir lu nos <a href="/mention-legales">conditions générales d\'utilisation</a>',
                'help_html' => true,

            ]
        )
        ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}