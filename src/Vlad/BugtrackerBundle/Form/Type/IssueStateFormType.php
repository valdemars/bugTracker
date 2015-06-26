<?php


namespace Vlad\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class IssueStateFormType extends AbstractType
{
    /**
     * Constructor
     *
     * @param integer            $projectId          Project ID (used to display user projects)
     * @param TranslationManager $translationManager TranslationManager
     * @param UserManager        $userManager        UserManager
     *
     * @return void
     */
    public function __construct($projectId, $translationManager, $userManager)
    {
        $this->projectId = $projectId;
        $this->translationManager = $translationManager;
        $this->userManager = $userManager;
    }

    /**
     * Function which defines the TicketForm inputs
     *
     * @param FormBuilderInterface $builder Form builder
     * @param array                $options Form ptions
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $projectId = $this->projectId;
        $userManager = $this->userManager;

        $builder->add(
            'content', 'textarea', array(
                'required' => false,
                'attr' => array('rows' => 5)
            )
        );

        $builder->add(
            'authorUser', 'entity', array(
                'class' => 'VladBugtrackerBundle:User',
                'property' => 'completeName'
            )
        );

        $builder->add(
            'allocatedUser', 'entity', array(
                'class' => 'VladBugtrackerBundle:User',
                'property' => 'completeName',
                'query_builder' => function ($er) use ($projectId, $userManager) {
                    return $er->findByProject($projectId, $userManager->getUser()->getId(), $userManager->isAdmin());
                }
            )
        );

        $builder->add(
            'type', 'choice', array(
                'choices' => array(
                    1 => $this->translationManager->trans('ticket_state.type.1'),
                    2 => $this->translationManager->trans('ticket_state.type.2'),
                    3 => $this->translationManager->trans('ticket_state.type.3'),
                    4 => $this->translationManager->trans('ticket_state.type.4')
                )
            )
        );

        $builder->add(
            'status', 'choice', array(
                'choices' => array(
                    1 => $this->translationManager->trans('ticket_state.status.1'),
                    2 => $this->translationManager->trans('ticket_state.status.2'),
                    3 => $this->translationManager->trans('ticket_state.status.3'),
                    4 => $this->translationManager->trans('ticket_state.status.4'),
                    5 => $this->translationManager->trans('ticket_state.status.5'),
                    6 => $this->translationManager->trans('ticket_state.status.6'),
                    7 => $this->translationManager->trans('ticket_state.status.7'),
                    8 => $this->translationManager->trans('ticket_state.status.8')
                )
            )
        );

        $builder->add(
            'priority', 'choice', array(
                'choices' => array(
                    1 => $this->translationManager->trans('ticket_state.priority.1'),
                    2 => $this->translationManager->trans('ticket_state.priority.2'),
                    3 => $this->translationManager->trans('ticket_state.priority.3')
                )
            )
        );
    }

    /**
     * Function which set the TicketStateForm default options
     *
     * @param OptionsResolverInterface $resolver OptionsResolverInterface
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Vlad\BugtrackerBundle\Entity\IssueState'
            )
        );
    }

    /**
     * Function which returns the TicketStateForm alias
     *
     * @return string
     */
    public function getName()
    {
        return 'vlad_bugtracker_issue_state';
    }
}
