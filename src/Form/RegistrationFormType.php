<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('adresse', TextType::class,[
                'invalid_message' => 'Le adresse n\'est pas valide!',
            ])
            ->add('cp', NumberType::class, [
                'required'   => true,            
                'invalid_message' => 'Le code postal n\'est pas valide!',
                'label' => 'Code postal'])
            ->add('ville', TextType::class,[
                'invalid_message' => 'Le ville n\'est pas valide!',
            ])
            ->add('telephone',NumberType::class,[
                'invalid_message' => 'Le telephone n\'est pas valide!',
            ])
            ->add('email',EmailType::class,[
                'invalid_message' => 'Le email n\'est pas valide!',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Comfirmation du mot de passe', 
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
