<?php

namespace VZ\CalendarBundle\Repository;

use Doctrine\ORM\EntityRepository;

class EventRepository extends EntityRepository
{
    /**
     * retrieve all events that are still happening in the future, order them by newest to oldest
     *
     * @return mixed
     */
    public function findAllCurrent()
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT e FROM VZCalendarBundle:Event e WHERE e.startDate >= CURRENT_DATE() ORDER BY e.startDate DESC'
        ); // ->setParameter('date', date('Y-m-d'));

        return $query->getResult();
    }
}
