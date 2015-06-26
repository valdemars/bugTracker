<?php

namespace Vlad\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * DashboardController class
 *
 * @category Controller
 * @package  VladBugtrackerBundle
 *
 */
class DashboardController extends Controller
{

    public function indexAction()
    {
	    $issues = $this->getDoctrine()
		    ->getRepository('VladBugtrackerBundle:Issue')
		    ->findAll();

        return $this->render('VladBugtrackerBundle:Dashboard:index.html.twig', [
	        'issues' => $issues
        ]);
    }

}
