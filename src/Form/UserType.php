<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
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
            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ], 
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('modifier', SubmitType::class)
        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
