<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

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
                    new Length(["min" => 8, "minMessage" => "Veuillez entrer un nom d'utilisateur entre 8 et 16 caractères", "max" => 16, "maxMessage" => "Veuillez entrer un nom d'utilisateur entre 8 et 16 caractères"])
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
        ->add(
            'birth_date', 
            BirthdayType::class,
            [
                'invalid_message' => 'Veuillez entrer une date valide', 
                'format' => 'dd-MM-yyyy',
                "label" => "Date d'anniversaire"
            ]
        )
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
                'help' => 'En cochant cette case, vous reconnaissez avoir lu nos <a href="">conditions générales d\'utilisation</a>',
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