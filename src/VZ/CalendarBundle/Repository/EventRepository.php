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

    /**
     * Retrieve all events that are over quota and past the quota date
     *
     * @param $date set this date for testing (otherwise send time())
     */
    public function findAllOverQuota($date)
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery(
            'SELECT e FROM VZCalendarBundle:Event e '
            . 'WHERE e.quotaNotifyDate >= :date '
            . 'AND e.usedSlots > e.quota '
            . 'AND e.quotaNotified is null ORDER BY e.startDate'
        )->setParameter('date', date('Y-m-d H:i:s', $date));

        return $query->getResult();
    }
}
