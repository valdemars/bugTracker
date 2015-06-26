<?php


namespace Vlad\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class IssueController extends Controller
{

    public function indexAction()
    {
	    $issues = $this->getDoctrine()
		    ->getRepository('VladBugtrackerBundle:Issue')
		    ->findAll();

        return $this->render('VladBugtrackerBundle:Issue:index.html.twig', [
	        'issues' => $issues
        ]);
    }


	public function editAction($ticketId)
	{
		$ticket = $this->container->get('vlad_bugtracker.issue_manager')->getIssue($ticketId);
		$form = $this->container->get('vlad_bugtracker.issue.form');
		$formHandler = $this->container->get('vlad_bugtracker.issue.form_handler');

		if ($formHandler->process($ticket)) {
			return $this->redirect($this->generateUrl('vlad_bugtracker_dashboard_page'));
		}

		$aParams['form'] = $form->createView();
		$aParams['issue'] = $ticket;

		return $this->render('VladBugtrackerBundle:Issue:edit.html.twig', $aParams);
	}


}
