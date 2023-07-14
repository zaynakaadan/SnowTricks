<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Tricks;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TricksFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', null, ['label' => 'Nom'])
        ->add('description')
            //->add('created_at')
        ->add('category', EntityType::class, [ 
            'class' => Categories::class,
             'choice_label' => 'name',
             'label' => 'Catégorie', 
 
            ])
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }
}
