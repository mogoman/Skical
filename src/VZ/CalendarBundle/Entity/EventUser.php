<?php
namespace VZ\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="VZ\CalendarBundle\Repository\EventUserRepository")
 * @ORM\Table(name="event_user")
 */
class EventUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="User")
     * @var type
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="attendees")
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * @var type
     */
    private $event;

    /**
     *
     * @ORM\Column(type="integer")
     */
    protected $reservedSlots;

    /**
     *
     * @ORM\Column(type="string", length=128)
     */
    protected $paymentMethod;

    /**
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $status;

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
     * Set user
     *
     * @param VZ\CalendarBundle\Entity\User $user
     * @return EventUser
     */
    public function setUser(\VZ\CalendarBundle\Entity\User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return VZ\CalendarBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param VZ\CalendarBundle\Entity\Event $event
     * @return EventUser
     */
    public function setEvent(\VZ\CalendarBundle\Entity\Event $event = null)
    {
        $this->event = $event;
        return $this;
    }

    /**
     * Get event
     *
     * @return VZ\CalendarBundle\Entity\Event 
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Set reservedSlots
     *
     * @param integer $reservedSlots
     * @return EventUser
     */
    public function setReservedSlots($reservedSlots)
    {
        $this->reservedSlots = $reservedSlots;
        return $this;
    }

    /**
     * Get reservedSlots
     *
     * @return integer 
     */
    public function getReservedSlots()
    {
        return $this->reservedSlots;
    }

    /**
     * Set paymentMethod
     *
     * @param string $paymentMethod
     * @return EventUser
     */
    public function setPaymentMethod($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        return $this;
    }

    /**
     * Get paymentMethod
     *
     * @return string 
     */
    public function getPaymentMethod()
    {
        return $this->paymentMethod;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return EventUser
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }
}