<?php

namespace App\Form;

use App\Entity\Bloodbag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodbagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('bagnumber')
            ->add('volume', NumberType::class, [
                'help' => 'volume (mL) of blood in this bag',
                'help_attr' => [ 'class' => 'text-muted small'],
                'attr' => [ 'class' => 'form-control'],
                'label_attr' => [ 'class' => 'sr-only']
            ])
            // ->add('donation')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bloodbag::class,
        ]);
    }
}
