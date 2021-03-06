<?php


namespace App\Form\Type;


use App\Entity\Article;
use App\Entity\Category;

use Symfony\Component\Form\AbstractType;
use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                    new Length( ["max" => 40, "maxMessage" => "Veuillez entrer un titre inférieur à 40 caractères"])
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
        ->add(
            'ingredients', 
            CollectionType::class, 
            [
                'entry_type' => ListIngredientType::class,
                'required' => true,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ]
        )   
        ->add(
            'categories', 
            EntityType::class, [
                'class' => Category::class,
                'required' => true,
                'choice_label' => function ($category) {
                    return $category->getName();
                }, 
                'label' => 'Catégories',
                'multiple' => true,
                'expanded' => true,
            ]
        )

        ->add(
            'articleImageFile',
            ImageType::class,
            [
                'label' => 'Illustration de votre article',
                'enable_remote' => false,
                'max_width' => 1280,
                'max_height' => 720,
                'aspect_ratios' => [],
                'cropper_options'=> [
                    'aspectRatio'=> 3,
                    'viewMode' => 0, 
                    'minCropBoxWidth' => 1280,
                    'minCropBoxHeight' => 720,
                    
                ],
                'preview_height' => 66,
                'preview_width' => 200,
                'upload_button_class' => 'btn w-75 ml-0 mt-1 btn-success',
                'save_button_class' => 'btn btn-success mx-0 w-25',
                'cancel_button_class' => 'btn btn-outline-secondary mx-0 w-25',
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