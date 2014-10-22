<?php

namespace UserManagement\UserMgtBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="confirm")
 * @ORM\Entity(repositoryClass="UserManagement\UserMgtBundle\Entity\ConfirmRepository")
 */
class Confirm
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     * @ORM\JoinColumn(name="userid", referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $confirmkey;

    /**
     * @ORM\Column(type="datetime", length=20)
     */
    private $confirmDate;

    /**
     * @ORM\Column(name="is_confirmed", type="boolean")
     */
    private $isConfirmed;

    public function __construct()
    {
        $this->setconfirmDate(new \DateTime());
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
     * Set email
     *
     * @param string $email
     * @return Confirm
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set confirmkey
     *
     * @param string $confirmkey
     * @return Confirm
     */
    public function setConfirmKey($confirmkey)
    {
        $this->confirmkey = $confirmkey;

        return $this;
    }

    /**
     * Get confirmkey
     *
     * @return string
     */
    public function getConfirmKey()
    {
        return $this->confirmkey;
    }

    /**
     * Set isConfirmed
     *
     * @param boolean $isConfirmed
     * @return Confirm
     */
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;

        return $this;
    }

    /**
     * Get isConfirmed
     *
     * @return boolean
     */
    public function getIsConfirmed()
    {
        return $this->isConfirmed;
    }

    /**
     * Set user
     *
     * @param \UserManagement\UserMgtBundle\Entity\User $user
     * @return Confirm
     */
    public function setUser(\UserManagement\UserMgtBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserManagement\UserMgtBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set confirmDate
     *
     * @param \DateTime $confirmDate
     * @return Confirm
     */
    public function setConfirmDate($confirmDate)
    {
        $this->confirmDate = $confirmDate ? clone $confirmDate : null;

        return $this;
    }

    /**
     * Get confirmDate
     *
     * @return \DateTime 
     */
    public function getConfirmDate()
    {
        return $this->confirmDate = $confirmDate ? clone $confirmDate : null;
    }
}
