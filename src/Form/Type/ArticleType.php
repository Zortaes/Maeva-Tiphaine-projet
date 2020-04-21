<?php


namespace App\Form\Type;


use App\Entity\Article;
use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add(
            'title', 
            TextType::class,
            [
                'label' => "Titre",
                'constraints' => [
                    new Length( ["max" => 22, "maxMessage" => "Veuillez entrer un titre inférieur à 22 caractères"])
                    ]
            ]
        )
        ->add(
            'summary', 
            TextType::class,
            [
                "label" => "Introduction",
                'help' => 'Votre introduction doit être courte, il s\'agit d\'une petite présentation de votre article (pas plus de 160 caractères)',
                'constraints' => [
                   new Length(["max" => 160, "maxMessage" => "Veuillez entrer un contenu inférieur à 160 caractères"]),       
                ]
                                
            ]
        )
        ->add(
            'instruction', 
            TextareaType::class,
            [
                "label" => "Instruction",
                'help' => 'Veuillez indiquer les instructions à suivre pour réussir votre fabrication',
                                
            ]
        )
        ->add('ingredients', CollectionType::class, [
            'entry_type' => ListIngredientType::class,
            'required' => true,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
            'allow_delete' => true,
        ])   
        ->add(
            'category', 
            EntityType::class, [
                'class' => Category::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }, 
                'label' => 'Catégorie',
            ]
        )
        ->add("Envoyer", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}