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
            ->add('nom',TextType::class,[
                'required' => false,             
            ])
            ->add('prenom',TextType::class,[
                'required' => false,             
            ])
            ->add('adresse', TextType::class,[
                'required' => false,             
            ])
            ->add('cp', NumberType::class, [
                'required' => false,                 
                'label' => 'Code postal'
            ])
            ->add('ville', TextType::class,[
                'required' => false,             
            ])
            ->add('telephone',NumberType::class,[
                'required' => false,             
            ])
            ->add('email',TextType::class,[
                'required' => false,  
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => 'Mot de passe',
                ],
                'second_options' => [
                    'label' => 'Comfirmation du mot de passe', 
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'required' => false,             
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
