<?php

namespace App\Form;

use App\Entity\Donation;
use App\Entity\Donor;
use App\Entity\Location;
use App\Entity\Sicktype;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class DonationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
                    ->add('locality', EntityType::class, [
                        'class' => Location::class,
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
                ;
            } else if ($donationStatus == 'blood_collection') {
                $form
                    ->add('bloodbags', CollectionType::class, [
                        'entry_type' => BloodbagType::class,
                        'entry_options' => ['label' => false],
                        'allow_add' => true,
                        'label_attr' => [ 'class' => 'sr-only'],
                    ])
                ;
            } else if ($donationStatus == 'blood_tests') {
                $form
                    ->add('testresult', TextareaType::class, [
                        'help' => 'Please enter blood test results data in the text box provided above',
                        'help_attr' => [ 'class' => 'pull-right pt-2'],
                        'attr' => [ 'class' => 'form-control col-12'],
                        'row_attr' => [ 'class' => 'col-12'],
                        'required' => false,
                        'label_attr' => [ 'class' => 'sr-only']
                    ])
                    ->add('serology', EntityType::class, [
                        'class' => Sicktype::class,
                        'help' => 'What type of sick',
                        'help_attr' => [ 'class' => 'text-muted small'],
                        'attr' => [ 'class' => 'form-control'],
                        'row_attr' => [ 'class' => 'col'],
                        'label_attr' => [ 'class' => 'sr-only'],
                        'required' => false,
                        'multiple' => true,
                        // 'allow_add' => true,
                        'by_reference' => false,
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
