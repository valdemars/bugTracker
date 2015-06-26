<?php


namespace Vlad\BugtrackerBundle\Form\Handler;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Vlad\BugtrackerBundle\Library\IssueManager;


class IssueFormHandler
{
    protected $form;
    protected $request;
    protected $issueManager;

    /**
     * Constructor
     *
     * @param FormInterface $form          FormInterface
     * @param Request       $request       Request
     * @param IssueManager $issueManager IssueManager
     *
     * @return void
     */
    public function __construct(FormInterface $form, Request $request, IssueManager $issueManager)
    {
        $this->form = $form;
        $this->request = $request;
        $this->issueManager = $issueManager;
    }

    /**
     * Function that handle the Issue form submission
     *
     * @param Issue $issue Issue to be processed
     *
     * @return boolean
     */
    public function process($issue)
    {
        $this->form->setData($issue);

        if ('POST' === $this->request->getMethod()) {
            $this->form->bind($this->request);

            if ($this->form->isValid()) {
                $this->issueManager->saveIssue($issue);

                return true;
            }
        }

        return false;
    }
}
