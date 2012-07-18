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
                'reservedSlots', 'choice', array(
                    'choices'   => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'),
                    'required'  => true,
                )
            )
            ->add('paymentMethod', 'choice', array(
                    'choices'   => array('onbus' => 'On Bus', 'transfer' => 'Bank Transfer'),
                    'required'  => true,
                )
            )
        ;
    }
    public function getName()
    {
        return 'eventuser';
    }
}
