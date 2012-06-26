<?php

namespace VZ\CalendarBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    /**
     * retrieve all events that are still happening in the future, order them showing the next one first
     *
     * @return DoctrineCollection
     */
    public function findAllCurrent()
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT e FROM VZCalendarBundle:Event e WHERE e.startDate >= CURRENT_DATE() ORDER BY e.startDate'
        ); // ->setParameter('date', date('Y-m-d'));

        return $query->getResult();
    }
}
