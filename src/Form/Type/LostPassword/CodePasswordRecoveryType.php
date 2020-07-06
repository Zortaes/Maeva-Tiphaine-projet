<?php

namespace App\Form\Type\LostPassword;


use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class CodePasswordRecoveryType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {

        $builder
      

        ->add(
            'code',
            TextType::class,
            [
                "label" => " ",
                'invalid_message' => 'Invalide',
                'constraints' => [
                   new Length(["min" => 5, "minMessage" => "Veuillez entrer un code à 5 chiffres", "max" => 5, "maxMessage" => "Veuillez entrer un code à 5 chiffres"]),
                ]
                                
            ]
        )
      

        ->add('Envoyer', SubmitType::class);
        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
       
    }

}