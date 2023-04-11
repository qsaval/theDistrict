<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RechercheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('recherche', SearchType::class)
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-4'
                ],
                'label' => 'Recherche'
            ])
        ;
    }

}