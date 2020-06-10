<?php

namespace App\Form;

use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', ChoiceType::class, [
                'choices' => [
                    'MR' => 'MR',
                    'MRS' => 'MRS',
                    'MS' => 'MS',
                    'MISS' => 'MISS',
                    'PROF' => 'PROF',
                    'DR' => 'DR',
                ],
                'label' => 'Title',
                'help' => 'Title',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'help' => 'First Name',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('middleName', TextType::class, [
                'label' => 'Middle Name',
                'help' => 'Middle Name',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'help' => 'Last Name',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dob', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date of Birth',
                'help' => 'Date of Birth',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'male',
                    'Female' => 'female',
                    'Other' => 'other',
                ],
                'label' => 'Gender',
                'help' => 'Gender',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('maritalStatus', ChoiceType::class, [
                'choices' => [
                    'Single' => 'single',
                    'Married' => 'married',
                    'Divorced' => 'divorced',
                    'Other' => 'other',
                ],
                'label' => 'Marital Status',
                'help' => 'Marital Status',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('bloodType', ChoiceType::class, [
                'choices' => [
                    'A' => 'A',
                    'B' => 'B',
                    'AB' => 'AB',
                    'O' => 'O',
                ],
                'label' => 'Blood Type',
                'help' => 'Blood Type',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('homeAddress', TextareaType::class, [
                'label' => 'Home Address',
                'help' => 'Home Address',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('personalEmail', EmailType::class, [
                'label' => 'Personal Email',
                'help' => 'Personal Email',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('personalPhoneNumber', NumberType::class, [
                'label' => 'Personal Phone Number',
                'help' => 'Personal Phone Number',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('businessAddress', TextareaType::class, [
                'label' => 'Business Address',
                'help' => 'Business Address',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('businessemail', EmailType::class, [
                'label' => 'Business Email',
                'help' => 'Business Email',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('businessPhoneNumber', NumberType::class, [
                'label' => 'Business Phone Number',
                'help' => 'Business Phone Number',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
            ->add('occupation', TextType::class, [
                'label' => 'Occupation',
                'help' => 'Occupation',
                'label_attr' => ['class'=>'sr-only'],
                'help_attr' => ['class'=>'text-muted sm'],
                'attr' => ['class' => 'form-control'],
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donor::class,
        ]);
    }
}
