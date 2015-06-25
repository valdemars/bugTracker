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
        return $this->render('VladBugtrackerBundle:Dashboard:index.html.twig');
    }

}
