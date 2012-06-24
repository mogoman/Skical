<?php
namespace VZ\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="VZ\CalendarBundle\Repository\EventRepository")
 * @ORM\Table(name="event")
 */
class Event
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="date")
     */
    public $startDate;

    /**
     * @ORM\Column(type="time")
     */
    public $startTime;

    /**
     * @ORM\Column(type="date")
     */
    public $endDate;

    /**
     * @ORM\Column(type="time")
     */
    public $endTime;

    /**
     *
     * @ORM\Column(type="string", length=512)
     */
    protected $summary;

    /**
     *
     * @ORM\Column(type="string", length=32768)
     */
    protected $details;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $totalSlots;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $usedSlots;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $quota;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $priceMember;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $priceNonMember;

    /**
     * @ORM\Column(type="datetime")
     */
    public $quotaNotifyDate;

    /**
     * @ORM\OneToMany(targetEntity="EventUser", mappedBy="event", cascade={"persist"}, orphanRemoval=true)
     * @var type
     */
    private $attendees;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set startDate
     *
     * @param date $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * Get startDate
     *
     * @return date 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set startTime
     *
     * @param time $startTime
     * @return Event
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        return $this;
    }

    /**
     * Get startTime
     *
     * @return time 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endDate
     *
     * @param date $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * Get endDate
     *
     * @return date 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set endTime
     *
     * @param time $endTime
     * @return Event
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        return $this;
    }

    /**
     * Get endTime
     *
     * @return time 
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Event
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * Set details
     *
     * @param string $details
     * @return Event
     */
    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    /**
     * Get details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set totalSlots
     *
     * @param integer $totalSlots
     * @return Event
     */
    public function setTotalSlots($totalSlots)
    {
        $this->totalSlots = $totalSlots;
        return $this;
    }

    /**
     * Get totalSlots
     *
     * @return integer 
     */
    public function getTotalSlots()
    {
        return $this->totalSlots;
    }

    /**
     * Set usedSlots
     *
     * @param integer $usedSlots
     * @return Event
     */
    public function setUsedSlots($usedSlots)
    {
        $this->usedSlots = $usedSlots;
        return $this;
    }

    /**
     * Get usedSlots
     *
     * @return integer 
     */
    public function getUsedSlots()
    {
        return $this->usedSlots;
    }

    /**
     * Set quota
     *
     * @param integer $quota
     * @return Event
     */
    public function setQuota($quota)
    {
        $this->quota = $quota;
        return $this;
    }

    /**
     * Get quota
     *
     * @return integer 
     */
    public function getQuota()
    {
        return $this->quota;
    }

    /**
     * Set priceMember
     *
     * @param integer $priceMember
     * @return Event
     */
    public function setPriceMember($priceMember)
    {
        $this->priceMember = $priceMember;
        return $this;
    }

    /**
     * Get priceMember
     *
     * @return integer 
     */
    public function getPriceMember()
    {
        return $this->priceMember;
    }

    /**
     * Set priceNonMember
     *
     * @param integer $priceNonMember
     * @return Event
     */
    public function setPriceNonMember($priceNonMember)
    {
        $this->priceNonMember = $priceNonMember;
        return $this;
    }

    /**
     * Get priceNonMember
     *
     * @return integer 
     */
    public function getPriceNonMember()
    {
        return $this->priceNonMember;
    }

    /**
     * Set quotaNotifyDate
     *
     * @param datetime $quotaNotifyDate
     * @return Event
     */
    public function setQuotaNotifyDate($quotaNotifyDate)
    {
        $this->quotaNotifyDate = $quotaNotifyDate;
        return $this;
    }

    /**
     * Get quotaNotifyDate
     *
     * @return datetime 
     */
    public function getQuotaNotifyDate()
    {
        return $this->quotaNotifyDate;
    }
    public function __construct()
    {
        $this->attendees = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add attendees
     *
     * @param VZ\CalendarBundle\Entity\EventUser $attendees
     * @return Event
     */
    public function addEventUser(\VZ\CalendarBundle\Entity\EventUser $attendees)
    {
        if ($this->totalSlots - $this->usedSlots - $attendees->getReservedSlots() < 0) {
            return false;
        }
        $this->attendees[] = $attendees;
        $this->usedSlots  += $attendees->getReservedSlots();
        return $this;
    }

    /**
     * Get attendees
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * Check if given user is attending this event
     *
     * @param User $user user object from logged in or other user (NOT EventUser Object)
     * @return true if the given user is attending, false if not
     */
    public function checkAttendee($user)
    {
        // run through linked records and check if any match given user
        foreach ($this->attendees as $attendee) {
            if ($attendee->getUser()->getId() == $user->getId()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Remove an attendee from this event
     *
     * @param User $user user object from logged in or other user (NOT EventUser Object)
     * @return bool true if the user was found and removed, else false
     */
    public function removeAttendee($user)
    {
        foreach ($this->attendees as $attendee) {
            if ($attendee->getUser()->getId() == $user->getId()) {
                $usedSlots = $this->usedSlots - $attendee->getReservedSlots();
                $this->setUsedSlots($usedSlots);

                $this->attendees->removeElement($attendee);
                return true;
            }
        }
        return false;
    }
}