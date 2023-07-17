<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('nbSeats', null , [
                'label' => 'Seats'
            ])
            ->add('nbDoors', null, [
                'label' => 'Doors'
            ])
            ->add('cost')
            ->add('color')
            ->add('description')
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => 'false'
                
                ])
            ->add('isSold', null, [
                'label' =>'Sold?'
            ]
            )
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
