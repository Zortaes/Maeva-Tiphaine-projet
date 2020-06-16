<?php

namespace App\Form\Type;

use App\Entity\Flag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class FlagType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {

        $builder
      

        ->add('option_value', ChoiceType::class,
        [
            'expanded' => false, 
            'label' => "pourquoi voulez vous signaler cet article ?",    
            'choices' => [
                'fausse information' => 1,
                'contenu indésirable' => 2,
                'Violence/Nudité' => 3,
                'Discours inappropriés' => 4,
                'Autre chose' => 5
            ],                        
        ])

        ->add('Valider', SubmitType::class);
        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flag::class,
        ]);
    }

}