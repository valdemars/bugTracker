<?php

namespace Vlad\BugtrackerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Vlad\BugtrackerBundle\Entity\IssueRepository")
 */
class Issue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50)
     */
    private $code;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

	/**
	 * @var Project $project
	 *
	 * @ORM\ManyToOne(targetEntity="Project")
	 * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
	 */
	protected $project;

	/**
	 * @var ArrayCollection $states
	 *
	 * @ORM\OneToMany(targetEntity="IssueState", mappedBy="issue", cascade={"remove"})
	 */
	protected $states;

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
	 * Add state
	 *
	 * @param IssueState $state
	 */
	public function addState(IssueState $state)
	{
		if (!$this->states->contains($state)) {
			$this->states->add($state);
		}
	}

	/**
	 * Set current_state
	 *
	 * @param IssueState $currentState
	 * @return Issue
	 */
	public function setCurrentState(IssueState $currentState)
	{
		$this->currentState = $currentState;
		return $this;
	}

	/**
	 * @var Project $project
	 *
	 * @ORM\ManyToOne(targetEntity="IssueState", cascade={"remove"})
	 * @ORM\JoinColumn(name="current_state_id", referencedColumnName="id", onDelete="SET NULL")
	 */
	protected $currentState;


	/**
	 * Get states
	 *
	 * @return states
	 */
	public function getStates()
	{
		return $this->states;
	}

    /**
     * Set summary
     *
     * @param string $summary
     * @return Issue
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
     * Set code
     *
     * @param string $code
     * @return Issue
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Issue
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Issue
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set project
     *
     * @param \Vlad\BugtrackerBundle\Entity\Project $project
     * @return Issue
     */
    public function setProject(\Vlad\BugtrackerBundle\Entity\Project $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Vlad\BugtrackerBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
    }
}
