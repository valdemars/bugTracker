<?php

namespace Vlad\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Vlad\BugtrackerBundle\Entity\Role
 *
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role implements RoleInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string $name
     */
    protected $name;

    /**
    * @ORM\ManyToMany(targetEntity="Vlad\UserBundle\Entity\User", mappedBy="roles")
    *
    * @var ArrayCollection $users
    */
    protected $users;


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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($value)
    {
        $this->name = $value;
    }

    /**
     * Implementation of getRole for the RoleInterface.
     *
     * @return string The role.
     */
    public function getRole()
    {
        return $this->getName();
    }

	/**
	 * @see \Serializable::serialize()
	 */
	public function serialize()
	{
		return \serialize(array(
			$this->id,
			$this->name
		));
	}

	/**
	 * @see \Serializable::unserialize()
	 */
	public function unserialize($serialized)
	{
		list(
			$this->id,
			$this->name
		) = \unserialize($serialized);
	}

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \Vlad\BugtrackerBundle\Entity\User $users
     * @return Role
     */
    public function addUser(\Vlad\BugtrackerBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Vlad\BugtrackerBundle\Entity\User $users
     */
    public function removeUser(\Vlad\BugtrackerBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
