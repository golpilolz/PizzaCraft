<?php
// src/Pizz/AdminBundle/Controller/AdminController.php

/**
 * \file      AdminController.php
 * \author    JAMInfo
 * \version   1.0
 * \date      28/02/2014
 * \brief     Controller de la partie administration du site internet
 *
 * \details   Affiche les différentes vue en fonction des routes qui lui sont demandées
 */

namespace Pizz\AdminBundle\Controller;

use Pizz\AdminBundle\Entity\Ingredient;
use Pizz\AdminBundle\Entity\Pizza;

use Pizz\adminBundle\Form\IngredientEditType;
use Pizz\AdminBundle\Form\IngredientType;
use Pizz\AdminBundle\Form\PizzaType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Httpfoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use JMS\SecurityExtraBundle\Annotation\Secure;

class AdminController extends Controller
{

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function indexAction()
    {
        return $this->render('PizzAdminBundle:Admin:index.html.twig');
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function pizzaAction()
    {
        $pizza = new Pizza;
        $form = $this->createForm(new PizzaType, $pizza);

        $request = $this->get('request');

        $em = $this->getDoctrine()->getManager();

        $pizz = $em->getRepository('PizzAdminBundle:Pizza')->findAll();
        $categories = $em->getRepository('PizzAdminBundle:TypeIngredient')->findAll();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em->persist($pizza);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Pizza bien ajoutée');

                return $this->redirect($this->generateUrl('admin_pizza'));
            }
        }

        return $this->render('PizzAdminBundle:Admin:ajouter.html.twig',array(
            'form' => $form->createView(),
            'pizza' => $pizz,
            'categories' => $categories
        ));
    }

    public function ingredientAction(Request $request)
    {
        $ingredient = new Ingredient;
        $form = $this->createForm(new IngredientType, $ingredient);

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);

            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Ingrédient bien ajouté');

                return $this->redirect($this->generateUrl('admin_ingredient'));
            }
        }

        $ingredients = $this->getDoctrine()
            ->getManager()
            ->getRepository('PizzAdminBundle:Ingredient')
            ->findAll();

        return $this->render('PizzAdminBundle:Admin:ingredient.html.twig',array(
            'form' => $form->createView(),
            'ingredients' => $ingredients
        ));
    }

    public function  itineraireAction()
    {
        $map = $this->get('ivory_google_map.map');
        $marker = $this->get('ivory_google_map.marker');

        return $this->render('PizzAdminBundle:Admin:itineraire.html.twig',array(
            'maps' => $map,
            'marker' => $marker
        ));
    }

    public function pdelAction(Request $request, Pizza $pizza)
    {
        $form = $this->createFormBuilder()->getForm();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($pizza);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Pizza bien supprimée');

                return $this->redirect($this->generateUrl('admin_pizza'));
            }
        }

        return $this->render('PizzAdminBundle:Admin:pdel.html.twig',array(
            'pizza' => $pizza,
            'form' => $form->createView()
        ));
    }

    public function idelAction(Request $request, Ingredient $ingredient)
    {
        $form = $this->createFormBuilder()->getForm();

        if ($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if ($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->remove($ingredient);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Ingrédient bien supprimée');

                return $this->redirect($this->generateUrl('admin_ingredient'));
            }
        }

        return $this->render('PizzAdminBundle:Admin:idel.html.twig',array(
            'ingredient' => $ingredient,
            'form' => $form->createView()
        ));
    }

    public function imodifAction(Request $request, Ingredient $ingredient)
    {
        $form = $this->createForm(new IngredientEditType(), $ingredient);

        if($request->getMethod() == 'POST')
        {
            $form->bind($request);
            if($form->isValid())
            {
                $em = $this->getDoctrine()->getManager();
                $em->persist($ingredient);
                $em->flush();

                $this->get('session')->getFlashBag()->add('info', 'Ingredient bien modifié');

                return $this->redirect($this->generateUrl('admin_ingredient'));
            }
        }

        $ingredients = $this->getDoctrine()
            ->getManager()
            ->getRepository('PizzAdminBundle:Ingredient')
            ->findAll();

        return $this->render('PizzAdminBundle:Admin:imodif.html.twig',array(
            'form' => $form->createView(),
            'ing' => $ingredient,
            'ingredients' => $ingredients
        ));
    }
}