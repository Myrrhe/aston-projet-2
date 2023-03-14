<?php

namespace App\Form;

use App\Entity\PatientRoom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientRoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startTime')
            ->add('endTime')
            ->add('patientId')
            ->add('roomId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PatientRoom::class,
        ]);
    }
}
