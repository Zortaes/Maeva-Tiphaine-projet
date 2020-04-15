<?php

namespace App\Form\Type;

use App\Entity\Contact;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;


class ContactType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add('email', EmailType::class,
            [
                "label" => "Votre email",
                'invalid_message' => 'L\'adresse email n\'est pas valide',
                'constraints' => [
                   new Length(["max" => 100, "maxMessage" => "Veuillez entrer un email plus court"]),       
                ]                                
            ])

        ->add('title', TextType::class,
            [
                "label" => "Titre du message",
                'constraints' => [
                   new Length(["max" => 30, "maxMessage" => "Veuillez entrer un titre plus court"]),       
                ]
            ])

        ->add('message', TextareaType::class,
            [
                "label" => "Votre message",
                'constraints' => [
                   new Length(["max" => 10000, "maxMessage" => "Veuillez entrer un message plus court"]),      
                ]
            ])

        ->add('Envoyer', SubmitType::class);
        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}