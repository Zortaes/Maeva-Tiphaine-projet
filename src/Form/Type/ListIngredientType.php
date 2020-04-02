<?php


namespace App\Form\Type;


use App\Entity\ListIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;



class ListIngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('disposition', HiddenType::class
        ) 
        ->add(
            'quantity', 
            TextType::class,
            [
                "label" => "Quantité",
                'constraints' => [
                   new Length(["max" => 20, "maxMessage" => "Veuillez renseigner une quantité inférieure à 20 caractères"])    
                ]
                                
            ]
        )
        ->add(
            'ingredient', 
            TextType::class,
            [
                "label" => "Ingrédient",
                'constraints' => [
                    new Length(["max" => 20, "maxMessage" => "Veuillez renseigner un ingrédient inférieure à 20 caractères"])  
                ]
                                
            ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class' => ListIngredient::class,
        ]);
    }
}