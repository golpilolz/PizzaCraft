<?php

namespace Pizz\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PizzaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('ingredients')
            ->add('ppetit')
            ->add('pnormale')
            ->add('image', new ImagePizzaType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pizz\AdminBundle\Entity\Pizza'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pizz_adminbundle_pizza';
    }
}
