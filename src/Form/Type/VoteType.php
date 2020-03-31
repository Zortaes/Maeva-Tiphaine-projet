<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VoteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vote_value', ChoiceType::class,
            [
                'label' => "Que pensez vous de cet article ?",
                'choices' => 
                [
                    'Médiocre' => 1,
                    'Pas mal' => 2,
                    'Bien' => 3,
                    'Super' => 4,
                    'Excellent' => 5
                ]
            ])
            
            ->add('save', SubmitType::class);
    }
}