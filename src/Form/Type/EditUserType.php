<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
        ->add(
            'plain_password', 
            PasswordType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'nouveau mot de passe', 
                'help' => 'ce champs n\'est pas obligatoire', 
                'constraints' => [
                new Length(["min" => 8, "minMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères", "max" => 16, "maxMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères"])
                ]
            ]
        )
        ->add(
            'roles', ChoiceType::class, [
                'choices' => ['ROLE_ADMIN' => 'ROLE_ADMIN', 'ROLE_USER' => 'ROLE_USER'],
                'expanded' => true,
                'multiple' => true,
            ]
        )
        ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();

            $form->getData()->setUsername($user['viewUsername']); 
            unset($user['viewUsername']);
                    
        })
        ->add('Modifier', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}