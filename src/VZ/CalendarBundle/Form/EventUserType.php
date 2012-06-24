<?php

namespace VZ\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'reservedSlots'
            )
            ->add('paymentMethod')
            ->add('status')
        ;
    }
    public function getName()
    {
        return 'event';
    }
}
