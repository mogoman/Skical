<?php

namespace VZ\CalendarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

class AdminEventUserType extends EventUserType
{
    /**
     * @var \VZ\CalendarBundle\Entity\Event
     */
    protected $event;

    public function __construct(\VZ\CalendarBundle\Entity\Event $event)
    {
        $this->event = $event;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $event = $this->event;
        $skipIds = array();
        foreach ($event->getAttendees() as $attendee) {
            $skipIds[] = $attendee->getUser()->getId();
        }

        $builder
            ->add(
                'user',
                'entity',
                array(
                    'class' => 'VZCalendarBundle:User',
                    'query_builder' => function(EntityRepository $er) use ($skipIds) {
                        $qb = $er->createQueryBuilder('u');
                        if (count($skipIds) > 0) {
                            $qb->add('where', $qb->expr()->notIn('u.id', $skipIds));
                        }
                        $qb->orderBy('u.username', 'ASC');

                        return $qb;
                    },
                )
            )
        ;
    }
}
