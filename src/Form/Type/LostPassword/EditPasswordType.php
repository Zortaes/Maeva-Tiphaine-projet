<?php


namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
        ->add(
            'plain_password', 
            RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'mapped' => false,
                'options' => [
                    'attr' => 
                    ['class' => 'password-field']
                ],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe'
                ],
                'second_options' => [
                    'label' => 'Confirmation de mot de passe'
                ],
                'constraints' => [
                new NotBlank(),
                new Length(["min" => 8, "minMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères", "max" => 16, "maxMessage" => "Veuillez entrer un mot de passe entre 8 et 16 caractères"])
                ]
            ]
        )
        ->add('Modifier', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}