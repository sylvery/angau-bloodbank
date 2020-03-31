<?php

namespace App\Form;

use App\Entity\Donation;
use App\Entity\Donor;
use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only']    
                    ])
                    ->add('locality', CollectionType::class, [
                        'entry_type' => Location::class,
                        'help' => 'Location',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only']    
                    ])
                    ->add('donor', EntityType::class, [
                        'class' => Donor::class,
                        'help' => 'Donor',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
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
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('ampleBlood', CheckboxType::class, [
                        'help' => 'Got enough blood to donate?',
                        'help_attr' => [ 'class' => 'pull-right pt-2 col-11'],
                        'attr' => [ 'class' => 'form-control col-1'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                    ])
                    ->add('wasSick', CheckboxType::class, [
                        'help' => 'Was sick in the past two weeks',
                        'help_attr' => [ 'class' => 'pull-right pt-2 col-11'],
                        'attr' => [ 'class' => 'form-control col-1'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                    ])
                    ->add('sicknesses', CollectionType::class, [
                        'entry_type' => SicktypeType::class,
                        'help' => 'What type of sick',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                        // 'allow_add' => true,
                        'by_reference' => false,
                    ])
                ;
            } else if ($donationStatus == 'blood_collection') {
                $form
                    ->add('volume', NumberType::class, [
                        'help' => 'Volume (Litres)',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('bags', IntegerType::class, [
                        'help' => 'Number of blood bags',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                ;
            } else if ($donationStatus == 'blood_tests') {
                $form
                    ->add('hivaids', CheckboxType::class, [
                        'help' => 'HIV/AIDS',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('malaria', CheckboxType::class, [
                        'help' => 'Malaria',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1'],
                        'row_attr' => [ 'class' => 'input-group'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('covid19', CheckboxType::class, [
                        'help' => 'Corona Virus 2019 (covid19)',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-1'],
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
