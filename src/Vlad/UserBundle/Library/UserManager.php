<?php


namespace Vlad\UserBundle\Library;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

use Vlad\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;


class UserManager
{
    protected $em;
    protected $repository;
    protected $encoderFactory;

	/**
	 * Constructor
	 *
	 * @param EntityManager   $em              EntityManager
	 * @param EncoderFactory  $encoderFactory  EncoderFactory
	 * @param SecurityContext $securityContext SecurityContext
	 * @param Session         $session         Session
	 *
	 * @return void
	 */
    public function __construct($em, EncoderFactory $encoderFactory, $securityContext, $session)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('VladUserBundle:User');
	    $this->encoderFactory = $encoderFactory;
	    $this->securityContext = $securityContext;

        $this->session = $session;
    }

	public function getUsers()
	{
		return $this->repository->findAll();
	}

	/**
	 * Function which creates a user
	 *
	 * @return User
	 */
	public function createUser()
	{
		return new User();
	}

	/**
	 * @param integer $userId User ID
	 *
	 * @return User
	 */
	public function getUserById($userId)
	{
		$user = $this->repository->find($userId);

		return ($user) ? $user : null;
	}

	/**
	 * Function which returns a user from Session
	 *
	 * @return User
	 */
	public function getUser()
	{
		return ($this->securityContext->getToken()) ? $this->securityContext->getToken()->getUser() : null;
	}

	/**
	 * Function which returns the project in session
	 *
	 * @return integer
	 */
	public function getProjectInSession()
	{
		$projectId = $this->session->get('current_project');

		return ($projectId) ? $this->repositoryProject->find($projectId) : null;
	}

	/**
	 * Function which saves a user in DB
	 *
	 * @param User $user User
	 *
	 * @return void
	 */
	public function saveUser($user)
	{
		//Password management
		$encoder = $this->encoderFactory->getEncoder($user);
		$password = $encoder->encodePassword($user->getPassword(), 'jjjjjjjjjjjjjjjjjjjjjj');
		//$user->setPassword($password);

		$this->em->persist($user);
		$this->em->flush();
	}

	/**
	 * Function which deletes a user in DB
	 *
	 * @param integer $userId User ID
	 *
	 * @return boolean
	 */
	/*public function deleteUser($userId)
	{
		$user = $this->getUserById($userId);
		try {
			$this->em->remove($user);
			$this->em->flush();
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}*/

	/**
	 * Function which checks if a user is an admin
	 *
	 * @return boolean
	 */
	public function isAdmin()
	{
		return $this->securityContext->isGranted('ROLE_ADMIN');
	}

}
