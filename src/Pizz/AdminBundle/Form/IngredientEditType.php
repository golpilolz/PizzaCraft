<?php
    // src/Pizz/AdminBundle/Form/IngredientEditType.php

    namespace Pizz\adminBundle\Form;

    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\OptionsResolverInterface;

    class IngredientEditType extends IngredientType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            // On fait appel à la méthode buildForm du parent, qui va ajouter tous les champs à $builder
            parent::buildForm($builder, $options);
        }

        // On modifie cette méthode, car les deux formulaires doivent avoir un nom différent
        public function getName()
        {
            return 'pizz_adminbundle_ingredientedittype';
        }
    }