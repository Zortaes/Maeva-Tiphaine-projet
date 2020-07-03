<?php

namespace App\Form\Type\LostPassword;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\IsTrue as RecaptchaTrue;



class SendEmailType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {

        $builder
      

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

        ->add('Envoyer', SubmitType::class);
        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }

}