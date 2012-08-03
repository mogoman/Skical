<?php
namespace VZ\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="event_log")
 */
class EventLog
{
    /**
     * constants for actions taken
     */
    const joined        = 'User joined event';
    const joinedbyadmin = 'Admin added user to event';
    const left          = 'User left event';
    const leftbyadmin   = 'Admin removed user from event';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    public $logDate;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $action;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    protected $detail;

    /**
     * Relationship with event - if the event is deleted, all logs will be cascade deleted
     * see http://stackoverflow.com/questions/6328535/on-delete-cascade-with-doctrine2
     *
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="logs", cascade={"remove"})
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * @var type
     */
    private $event;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="logs")
     * @ORM\JoinColumn(name="fos_user_id", referencedColumnName="id")
     * @var type
     */
    private $user;

    /**
     * constructor - setup stuff automatically when this is created as an object
     */
    public function __construct()
    {
        $this->logDate = new \DateTime("now");
    }

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
     * Set logDate
     *
     * @param datetime $logDate
     * @return EventLog
     */
    public function setLogDate($logDate)
    {
        $this->logDate = $logDate;
        return $this;
    }

    /**
     * Get logDate
     *
     * @return datetime 
     */
    public function getLogDate()
    {
        return $this->logDate;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return EventLog
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set event
     *
     * @param VZ\CalendarBundle\Entity\Event $event
     * @return EventLog
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
     * Set user
     *
     * @param VZ\CalendarBundle\Entity\User $user
     * @return EventLog
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
     * Set detail
     *
     * @param string $detail
     * @return EventLog
     */
    public function setDetail($detail)
    {
        $this->detail = $detail;
        return $this;
    }

    /**
     * Get detail
     *
     * @return string 
     */
    public function getDetail()
    {
        return $this->detail;
    }
}