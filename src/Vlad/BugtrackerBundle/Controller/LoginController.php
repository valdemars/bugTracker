<?php


namespace Vlad\BugtrackerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;


class LoginController extends Controller
{
    /**
     * Index action
     *
     * @return Response
     */
    public function indexAction()
    {
        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        $aParams['last_username'] = $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME);
        $aParams['error'] = $error;

        return $this->render('VladBugtrackerBundle:Partial:login.html.twig', $aParams);
    }

    /**
     * Check action
     *
     * @return Response
     */
    public function checkAction()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }
}
