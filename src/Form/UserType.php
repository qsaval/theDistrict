<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
        ->add('nom',TextType::class, [
            'required'   => false
        ])
        ->add('prenom',TextType::class, [
            'required'   => false
        ])
        ->add('adresse', TextType::class,[
            'required'   => false        ])
        ->add('cp', NumberType::class, [
            'required'   => false,
            'label' => 'Code postal'
        ])
        ->add('ville', TextType::class,[
            'required'   => false        
        ])
        ->add('telephone',NumberType::class,[
            'required'   => false        
        ])
        ->add('email',EmailType::class,[
            'required'   => false
        ])
            ->add('plainPassword', PasswordType::class, [
                'attr' => [
                    'class' => 'form-control'
                ], 
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required'   => false
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
