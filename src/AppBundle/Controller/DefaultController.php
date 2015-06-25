<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
	    //var_dump(get_declared_classes());
	    var_dump(class_exists('\Acme\DemoBundle\AcmeDemoBundle'));
        return $this->render('default/index.html.twig');
    }
}
