<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'help' => 'Location Name',
                'help_attr' => [ 'class' => 'text-muted small'],
                'attr' => [ 'class' => 'form-control'],
                'row_attr' => [ 'class' => 'col'],
                'label_attr' => [ 'class' => 'sr-only']    
            ])
            ->add('longitude', TextType::class, [
                'help' => 'Longitude',
                'help_attr' => [ 'class' => 'text-muted small'],
                'attr' => [ 'class' => 'form-control'],
                'row_attr' => [ 'class' => 'col'],
                'label_attr' => [ 'class' => 'sr-only']    
            ])
            ->add('latitude', TextType::class, [
                'help' => 'Latitude',
                'help_attr' => [ 'class' => 'text-muted small'],
                'attr' => [ 'class' => 'form-control'],
                'row_attr' => [ 'class' => 'col'],
                'label_attr' => [ 'class' => 'sr-only']    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
