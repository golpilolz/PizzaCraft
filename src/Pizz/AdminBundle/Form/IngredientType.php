<?php

namespace Pizz\AdminBundle\Form;

use Pizz\AdminBundle\Entity\TypeIngredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class IngredientType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('designation')
            ->add('prix')
            ->add('type', 'entity', array(
                'class' => 'PizzAdminBundle:TypeIngredient',
                'property' => 'nom'
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pizz\AdminBundle\Entity\Ingredient'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pizz_adminbundle_ingredient';
    }
}
