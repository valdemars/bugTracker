<?php

namespace Vlad\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Vlad\BugtrackerBundle\Form\Type\IssueStateFormType;

class IssueFormType extends AbstractType
{
    protected $userManager;
    protected $translationManager;

    /**
     * Constructor
     *
     * @param UserManager        $userManager        UserManager
     * @param TranslationManager $translationManager TranslationManager
     *
     * @return void
     */
    public function __construct($userManager, $translationManager)
    {
        $this->userManager = $userManager;
        $this->translationManager = $translationManager;
    }

    /**
     * Function which defines the IssueForm inputs
     *
     * @param FormBuilderInterface $builder Form builder
     * @param array                $options Form ptions
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $translationManager = $this->translationManager;
        $userManager = $this->userManager;

	    $builder->add('code', 'text');

        /*$builder->add('title', 'text');*/

        $builder->add(
            'project', 'entity', array(
                'class' => 'VladBugtrackerBundle:Project',
                'property' => 'name',
                'query_builder' => function ($er) use ($userManager) {
                    return $er->getByUser($userManager->getUser()->getId(), $userManager->isAdmin());
                }
            )
        );


    }

    /**
     * Function which set the IssueForm default options
     *
     * @param OptionsResolverInterface $resolver OptionsResolverInterface
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Vlad\BugtrackerBundle\Entity\Issue'
            )
        );
    }

    /**
     * Function which returns the IssueForm alias
     *
     * @return string
     */
    public function getName()
    {
        return 'vlad_bugtracker_issue';
    }
}
