<?php


namespace Vlad\UserBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Vlad\UserBundle\Library\UserManager;

class UserFormHandler
{
    protected $form;
    protected $request;
    protected $userManager;

    /**
     * Constructor
     *
     * @param FormInterface $form        FormInterface
     * @param Request       $request     Request
     * @param UserManager   $userManager UserManager
     *
     * @return void
     */
    public function __construct(FormInterface $form, Request $request, UserManager $userManager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->userManager = $userManager;
    }

    /**
     * Function that handle the User form submission
     *
     * @param User $user User to be processed
     *
     * @return boolean
     */
    public function process($user)
    {
        $this->form->setData($user);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->userManager->saveUser($user);

                return true;
            }
        }

        return false;
    }
}
