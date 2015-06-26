<?php

namespace Vlad\BugtrackerBundle\Library;

//use Vlad\BugtrackerBundle\Utility\Pagination;
use Vlad\BugtrackerBundle\Entity\Issue;
//use Vlad\BugtrackerBundle\Entity\TicketState;


class IssueManager
{
    protected $em;
    protected $repository;

    /**
     * Constructor
     *
     * @param EntityManager $em          EntityManager
     * @param UserManager   $userManager UserManager
     *
     * @return void
     */
    public function __construct($em, $userManager)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository('VladBugtrackerBundle:Issue');
        //$this->repositoryState = $this->em->getRepository('VladBugtrackerBundle:IssueState');
        $this->userManager = $userManager;
    }

    /**
     * Function which returns tickets paginated list
     *
     * @param integer $pageNumber Page number
     *
     * @return Repository
     */
    /*public function getTicketsPaginatedList($pageNumber)
    {
        $pagination = $this->getTicketsPagination($pageNumber);

        return $this->repository->getByUser($this->userManager->getUser()->getId(), $pagination->itemsPerPageNumber, $pagination->itemsOffset, ($this->userManager->getProjectInSession() ? $this->userManager->getProjectInSession()->getId() : null), ($this->userManager->getUserInSession() ? $this->userManager->getUserInSession()->getId() : null), ($this->userManager->getTypeInSession() ? $this->userManager->getTypeInSession() : null), ($this->userManager->getStatusInSession() ? $this->userManager->getStatusInSession() : null), ($this->userManager->getPriorityInSession() ? $this->userManager->getPriorityInSession() : null));
    }*/

    /**
     * Function which returns tickets Pagination
     *
     * @param integer $pageNumber Page number
     *
     * @return Pagination
     */
    /*public function getTicketsPagination($pageNumber)
    {
        return Pagination::getPagination($pageNumber, $this->repository->getTotalNumber(), 10);
    }*/

    /**
     * Function which creates a ticket
     *
     * @return Ticket
     */
    /*public function createTicket()
    {
        $ticket = new Ticket();
        $ticket_state = new TicketState();
        $ticket_state->setStatus(3);
        $ticket_state->setPriority(2);
        $ticket_state->setTicket($ticket);
        $ticket->addState($ticket_state);
        $ticket->setCurrentState($ticket_state);

        return $ticket;
    }*/

    /**
     * Function which saves a ticket in DB
     *
     * @param Issue $issue Issue
     *
     * @return void
     */
    public function saveIssue($issue)
    {
        $aStates = $issue->getStates();
	    $issueState = $aStates[sizeof($aStates) - 1];
	    $issue->addState($issueState);
	    $issue->setCurrentState($issueState);
        $issueState->setIssue($issue);
        $this->em->persist($issueState);
        $this->em->persist($issueState);
        $this->em->flush();
    }

    /**
     * Function which returns a ticket from DB
     *
     * @param integer $ticketId Ticket ID
     *
     * @return Ticket
     */
    public function getIssue($ticketId)
    {
        $ticket = $this->repository->find($ticketId);
	    //$ticket_state = $this->getLastTicketStateCopy($ticketId);
	    //$ticket->addState($ticket_state);
	    return ($ticket) ? $ticket : false;
    }

    /**
     * Function which returns a copy of the last state of a ticket
     *
     * @param integer $ticketId Ticket ID
     *
     * @return Ticket
     */
    /*public function getLastTicketStateCopy($ticketId)
    {
        $ticket = $this->repository->find($ticketId);
        $ticket_state = new TicketState();
        if ($ticket->getCurrentState()) {
            $last_ticket_state = $this->repositoryState->find($ticket->getCurrentState()->getId());
            $ticket_state->setAuthorUser($this->userManager->getUser());
            $ticket_state->setAllocatedUser($last_ticket_state->getAllocatedUser());
            $ticket_state->setType($last_ticket_state->getType());
            $ticket_state->setStatus($last_ticket_state->getStatus());
            $ticket_state->setPriority($last_ticket_state->getPriority());
        }
        $ticket_state->setTicket($ticket);

        return ($ticket_state) ? $ticket_state : false;
    }*/

    /**
     * Function which deletes a ticket in DB
     *
     * @param integer $ticketId Ticket ID
     *
     * @return boolean
     */
    /*public function deleteTicket($ticketId)
    {
        $ticket = $this->getTicket($ticketId);
        try {
            $this->em->remove($ticket);
            $this->em->flush();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }*/
}
