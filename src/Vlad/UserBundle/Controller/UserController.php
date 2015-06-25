<?php


namespace Vlad\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * UserController class
 *
 * @category Controller
 * @package  VladUserBundle
 *
 */
class UserController extends Controller
{
    /**
     * Index action
     *
     * @return Response
     */
    public function indexAction()
    {
	    $users = $this->getDoctrine()
		    ->getRepository('VladUserBundle:User')
		    ->findAll();

	    return $this->render('VladUserBundle:User:index.html.twig', ['users' => $users]);
    }


	/**
	 * Edit user action
	 *
	 * @param integer $userId User ID
	 *
	 * @return Response
	 */
	public function editAction($userId)
	{
		$user = $this->getDoctrine()
			->getRepository('VladUserBundle:User')
			->find($userId);

		$form = $this->container->get('vlad_user.user.form');
		$formHandler = $this->container->get('vlad_user.user.form_handler');

		if ($formHandler->process($user)) {
			//$this->get('session')->setFlash('user_updated', 1);
			return $this->redirect($this->generateUrl('vlad_user_user'));
		}

		$params = [];
		$params['form'] = $form->createView();
		$params['user'] = $user;

		return $this->render('VladUserBundle:User:edit.html.twig', [
			'user' => $user,
			'form' => $form->createView()
		]);
	}

	/**
	 * Delete user action
	 *
	 * @param integer $userId User ID
	 *
	 * @return Response
	 */
	/*public function deleteAction($userId)
	{
		$this->container->get('vlad_bugtracker.user_manager')->deleteUser($userId);

		return $this->redirect($this->generateUrl('vlad_bugtracker_user'));
	}*/

}
