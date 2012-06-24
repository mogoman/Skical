<?php

namespace VZ\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('summary')
            ->add(
                'details',
                'textarea',
                array(
                    'required' => false,
                    'label' => 'event_form_details',
                    'attr' => array('class' => 'abc')
                )
            )
            ->add('startDate')
            ->add('startTime')
            ->add('endDate')
            ->add('endTime')
            ->add('totalSlots')
            ->add('quota')
            ->add('quotaNotifyDate')
            ->add('priceMember')
            ->add('priceNonMember')
        ;
    }
    public function getName()
    {
        return 'event';
    }
}
