<?php

namespace VZ\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class AdminUserProfileType extends BaseType
{
    /**
     * This overrides the profile form. The "current_password" needs to be dropped
     * as this is required by the normal user to update his profile (admin needs to
     * be able to edit without knowing/changing their password)
     *
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('current_password') // drop this field - see text above
            ->add('firstName')
            ->add('lastName')
            ->add('enabled', null, array('required' => false))
            ->add('isMember', null, array('required' => false))
        ;
    }
}
