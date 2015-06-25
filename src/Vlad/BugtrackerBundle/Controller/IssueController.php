<?php


namespace Vlad\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class IssueController extends Controller
{

    public function indexAction()
    {
        /*$form = $this->container->get('webaccess_bugtracker.ticket_filter.form');
        $formHandler = $this->container->get('webaccess_bugtracker.ticket_filter.form_handler');

        if ($formHandler->process()) {
            return $this->redirect($this->generateUrl('webaccess_bugtracker_ticket'));
        }

        $aParams['tickets'] = $this->container->get('webaccess_bugtracker.ticket_manager')->getTicketsPaginatedList($pageNumber);
        $aParams['pagination'] = $this->container->get('webaccess_bugtracker.ticket_manager')->getTicketsPagination($pageNumber);
        $aParams['form'] = $form->createView();*/


	    $issues = [];
	    $issues = $this->getDoctrine()
		    ->getRepository('VladBugtrackerBundle:Issue')
		    ->findAll();

        return $this->render('VladBugtrackerBundle:Issue:index.html.twig', [
	        'issues' => $issues
        ]);
    }


}
