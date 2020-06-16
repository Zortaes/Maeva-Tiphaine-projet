<?php

namespace App\Form\Type;

use App\Entity\Flag;

use App\Entity\Contact;
use Symfony\Component\Form\RatioType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class FlagType extends AbstractType
{
    public function buildform(FormBuilderInterface $builder, array $options)
    {

        $builder
      

        ->add('option_value', ChoiceType::class,
        [
            'expanded' => false, 
            'label' => "",    
            'choices' => [
                'fausse information' => 1,
                'contenu indésirable' => 2,
                'Violence/Nudité' => 3,
                'Discours inappropriés' => 4,
                'Autre chose' => 5
            ],                        
        ])

        ->add('Envoyer', SubmitType::class);
        
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flag::class,
        ]);
    }

}