<?php

namespace VZ\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EventType extends AbstractType
{
    /**
     * Builds the form for an Event (for adding or editing an event)
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
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
            ->add(
                'startDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd.MM.yyyy',
                    'attr' => array('class' => 'date')
                )
            )
            ->add('startTime', 'time', array(
                    'widget' => 'single_text',
                    'attr' => array('class' => 'time')
                )
            )
            ->add('cutoffDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd.MM.yyyy',
                    'attr' => array('class' => 'date')
                )
            )
            ->add('cutoffTime', 'time', array(
                    'widget' => 'single_text',
                    'attr' => array('class' => 'time')
                )
            )
            ->add('totalSlots')
            ->add('quota')
            ->add('quotaNotifyDate', 'date', array(
                    'widget' => 'single_text',
                    'format' => 'dd.MM.yyyy',
                    'attr' => array('class' => 'date')
                )
            )
            ->add('priceMember', 'integer')
            ->add('priceNonMember', 'integer')
        ;
    }
    public function getName()
    {
        return 'event';
    }
}
