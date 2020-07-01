<?php

namespace App\Form;

use App\Entity\Bloodbag;
use App\Entity\Bloodtest;
use App\Entity\Sicktype;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BloodtestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('comment')
            ->add('sickfound', EntityType::class, [
                'class' => Sicktype::class,
                'multiple' => true,
                'expanded' => true,
                'choice_attr' => ['class' => 'input-group'],
                'placeholder' => 'Select type sickness',
            ])
            ->add('bloodbag', EntityType::class, [
                'class' => Bloodbag::class,
                'placeholder' => 'Select bloodbags tested',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('b')
                              ->where('b.checked = 0')
                              ->orderBy('b.id', 'DESC')
                              ;
                }
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bloodtest::class,
        ]);
    }
}
