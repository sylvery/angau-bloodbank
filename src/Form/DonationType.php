<?php

namespace App\Form;

use App\Entity\Donation;
use App\Entity\Donor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DonationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // $builder
        //     ->add('date', DateType::class, [
        //         'widget' => 'single_text',
        //         'help' => 'Donation Date',
        //         'help_attr' => [
        //             'class' => 'text-muted small'],
        //         'attr' => [
        //             'class' => 'form-control',
        //         ],
        //         'label_attr' => [
        //             'class' => 'sr-only',
        //         ]    
        //     ])
        //     ->add('location', TextType::class, [
        //         'help' => 'Location',
        //         'help_attr' => [
        //             'class' => 'text-muted small'],
        //         'attr' => [
        //             'class' => 'form-control',
        //         ],
        //         'label_attr' => [
        //             'class' => 'sr-only',
        //         ]    
        //     ])
        //     ->add('donor', EntityType::class, [
        //         'class' => Donor::class,
        //         'help' => 'Donor',
        //         'help_attr' => [
        //             'class' => 'text-muted small'],
        //         'attr' => [
        //             'class' => 'form-control',
        //         ],
        //         'label_attr' => [
        //             'class' => 'sr-only',
        //         ]                
        //     ])
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            $donation = $event->getData();
            // $donationStatus = key($donation->getCurrentPlace());
            $donationStatus = $donation->getCurrentPlace();
            $form = $event->getForm();
            if (!$donation || null == $donation->getId()) {
                $form
                    ->add('date', DateType::class, [
                        'widget' => 'single_text',
                        'help' => 'Donation Date',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']    
                    ])
                    ->add('location', TextType::class, [
                        'help' => 'Location',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']    
                    ])
                    ->add('donor', EntityType::class, [
                        'class' => Donor::class,
                        'help' => 'Donor',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']                
                    ])
                ;
            }
            if ($donationStatus == 'physical_checks') {
                $form       
                    ->add('weight', NumberType::class, [
                        'help' => 'Weight in kilograms (kg)',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('ampleBlood', CheckboxType::class, [
                        'help' => 'Got enough blood to donate?',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1 float-left'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                    ])
                    ->add('wasSick', CheckboxType::class, [
                        'help' => 'Was sick in the past two weeks',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1 float-left'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                    ])
                    ->add('whatSick', TextType::class, [
                        'help' => 'What type of sick',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                    ])
                ;
            } else if ($donationStatus == 'blood_collection') {
                $form
                    ->add('volume', NumberType::class, [
                        'help' => 'Volume (Litres)',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('bags', NumberType::class, [
                        'help' => 'Number of blood bags',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                ;
            } else if ($donationStatus == 'blood_tests') {
                $form
                    ->add('hivaids', CheckboxType::class, [
                        'help' => 'HIV/AIDS',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1 float-left'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('malaria', CheckboxType::class, [
                        'help' => 'Malaria',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1 float-left'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('covid19', CheckboxType::class, [
                        'help' => 'Corona Virus 2019 (covid19)',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1 float-left'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                ;

            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Donation::class,
        ]);
    }
}
