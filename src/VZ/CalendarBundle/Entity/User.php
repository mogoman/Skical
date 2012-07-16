<?php
namespace VZ\CalendarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @ORM\Entity(repositoryClass="VZ\CalendarBundle\Repository\UserRepository")
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     *
     */
    protected $firstName;

    /**
     *
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    protected $lastName;

    /**
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isMember;

    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set isMember
     *
     * @param boolean $isMember
     * @return User
     */
    public function setIsMember($isMember)
    {
        $this->isMember = $isMember;
        return $this;
    }

    /**
     * Get isMember
     *
     * @return boolean 
     */
    public function getIsMember()
    {
        return $this->isMember;
    }

}