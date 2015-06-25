<?php


namespace Vlad\BugtrackerBundle\Library;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Vlad\BugtrackerBundle\Utility\Pagination;
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
        $this->repository = $this->em->getRepository('VladBugtrackerBundle:User');
	    $this->encoderFactory = $encoderFactory;

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
		$password = $encoder->encodePassword($user->getPassword(), 'asd');
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
	public function deleteUser($userId)
	{
		$user = $this->getUserById($userId);
		try {
			$this->em->remove($user);
			$this->em->flush();
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

}
