<?php

namespace Vlad\BugtrackerBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class UserFormType extends AbstractType
{
    /**
     * Function which defines the UserForm inputs
     *
     * @param FormBuilderInterface $builder Form builder
     * @param array                $options Form ptions
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text');
	    $builder->add('fullname', 'text');
	    $builder->add('email', 'text');
	    $builder->add('password', 'text');
    }

    /**
     * Function which set the UserForm default options
     *
     * @param OptionsResolverInterface $resolver OptionsResolverInterface
     *
     * @return void
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Vlad\UserBundle\Entity\User'
            )
        );
    }

    /**
     * Function which returns the UserForm alias
     *
     * @return string
     */
    public function getName()
    {
        return 'vlad_bugtracker_user';
    }
}
