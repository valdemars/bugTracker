<?php

namespace Vlad\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\FOSUserBundle;
use Vlad\UserBundle\VladUserBundle;

/**
 * Vlad\BugtrackerBundle\Entity\IssueState
 *
 * @ORM\Table(name="issue_state")
 * @ORM\Entity(repositoryClass="Vlad\BugtrackerBundle\Repository\IssueStateRepository")
 */
class IssueState
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var text $content
     *
     * @ORM\Column(name="content", type="text", nullable=true)
     */
    protected $content;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Issue", inversedBy="states")
     * @ORM\JoinColumn(name="issue_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $issue;

    /**
     * @var FOSUserBundle $authorUser
     *
     * @ORM\ManyToOne(targetEntity="Vlad\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $authorUser;

    /**
     * @var FOSUserBundle $allocatedUser
     *
     * @ORM\ManyToOne(targetEntity="Vlad\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="allocated_user_id", referencedColumnName="id")
     */
    protected $allocatedUser;

    /**
     * @var integer $type
     *
     * @ORM\Column(name="type", type="integer")
     */
    protected $type;

    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="integer")
     */
    protected $status;

   /**
     * @var integer $priority
     *
     * @ORM\Column(name="priority", type="integer")
     */
    protected $priority;

	/**
	 * Set issue
	 *
	 * @param issue $issue
	 * @return IssueState
	 */
	public function setIssue(Issue $issue)
	{
		$this->issue = $issue;
		return $this;
	}


    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->createdAt = new \Datetime('now');
        $this->content = '';
        $this->authorUser = NULL;
        $this->allocatedUser = NULL;
        $this->status = 1;
        $this->priority = 1;
        $this->type = 1;
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
     * Set content
     *
     * @param text $content
     * @return IssueState
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Get content
     *
     * @return text
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set type
     *
     * @param $type
     * @return IssueState
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return issue_type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param $status
     * @return IssueState
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return issue_status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set priority
     *
     * @param $priority
     * @return IssueState
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
        return $this;
    }

    /**
     * Get priority
     *
     * @return priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return IssueState
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }



    /**
     * Get issue
     *
     * @return issue
     */
    public function getIssue()
    {
        return $this->issue;
    }

	/**
	 * Set authorUser
	 *
	 * @param FOSUserBundle $authorUser
	 * @return IssueState
	 */
    public function setAuthorUser(\Vlad\UserBundle\Entity\User $authorUser)
    {
        $this->authorUser = $authorUser;
        return $this;
    }

    /**
     * Get authorUser
     *
     * @return authorUser
     */
    public function getAuthorUser()
    {
        return $this->authorUser;
    }

    /**
     * Set allocatedUser
     *
     * @param FOSUserBundle $allocatedUser
     * @return UserState
     */
    public function setAllocatedUser(\Vlad\UserBundle\Entity\User $allocatedUser)
    {
        $this->allocatedUser = $allocatedUser;
        return $this;
    }

    /**
     * Get allocatedUser
     *
     * @return allocatedUser
     */
    public function getAllocatedUser()
    {
        return $this->allocatedUser;
    }
}
