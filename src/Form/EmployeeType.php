<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uuid', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col'],
            ])
            // ->add('roles', ChoiceType::class, [
            //     'multiple' => false,
            //     'expanded' => false,
            //     'choices' => [
            //         'ROLE_ADMIN'
            //     ],
            //     'attr' => ['class' => 'form-control'],
            // ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control'],
                'row_attr' => ['class' => 'col'],
            ])
            // ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
