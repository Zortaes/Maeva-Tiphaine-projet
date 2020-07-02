<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Presta\ImageBundle\Form\Type\ImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


class EditSelfType extends AbstractType
{
    private $manager;

 

    public function __construct(EntityManagerInterface $manager) 
    {
        $this->manager = $manager; 
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('avatarFile', 
        ImageType::class, [
            'label' => 'Avatar (facultatif)',
            'enable_remote' => false,
            'max_width' => 200,
            'max_height' => 200, 
            'aspect_ratios' => [],
            'cropper_options'=> [
                'aspectRatio'=> 1,  
                'viewMode' => 1,
                'minCropBoxWidth' => 120, 
                'minCropBoxHeight' => 120, 
            ],
            'preview_height' => 200, 
            'preview_width' => 200, 
            'upload_button_class' => 'btn w-75 ml-0 mt-1 btn-success',
            'save_button_class' => 'btn btn-success mx-0 w-25',
            'cancel_button_class' => 'btn btn-outline-secondary mx-0 w-25'      
        ])      

        ->add(
            'viewUsername', 
            TextType::class,
            [ 
                'label' => "Nom d'utilisateur", 
                'constraints' => [
                    new Length(["min" => 5, "minMessage" => "Veuillez entrer un nom d'utilisateur entre 5 et 50 caractères", "max" => 50, "maxMessage" => "Veuillez entrer un nom d'utilisateur entre 5 et 50 caractères"]), 
                    
                ],
                
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
        ->addEventListener(FormEvents::PRE_SUBMIT,  function (FormEvent $event) {
            $user = $event->getData();
            $form = $event->getForm();
            

            /* Delete spaces before and after string */
            $usernameTrimmed = trim($user['viewUsername'], " "); 
            
            
            /* Search if username exist for display error */
            $uniqueUsername = $this->manager->getRepository(User::class)->findBy([
                "username" => $usernameTrimmed
            ]); 



            /* if the user change his username with an username unique (don't exist in database) or if the user don't change his username */
            if ($uniqueUsername === [] || $form->getData()->getViewUsername() === $uniqueUsername[0]->getViewUsername())
            {
                $form->getData()->setUsername($usernameTrimmed);  
                unset($user['viewUsername']); 
            }
            else 
            {
               /* passe ici mais ne veut pas que je rentre autre chose que viewUsername */
                $form->getData()->setUsername('notUnique'); 
                unset($user['viewUsername']);   
                  
            }

             
           
        })
        ->add('Enregistrer', SubmitType::class)
        ;
    }

    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}