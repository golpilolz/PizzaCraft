<?php
    // src/Pizz/SiteBundle/Controller/SiteController.php

    /**
    * \file      SiteController.php
    * \author    JAMInfo
    * \version   1.0
    * \date      19/02/2014
    * \brief     Controller du site internet
    *
    * \details   Affiche les différentes vue en fonction des routes qui lui sont demandées
    */

    namespace Pizz\SiteBundle\Controller;

    use Pizz\SiteBundle\Entity\CB;
    use Pizz\SiteBundle\Entity\Commentaire;
    use Pizz\SiteBundle\Entity\Contact;
    use Pizz\SiteBundle\Form\CBType;
    use Pizz\SiteBundle\Form\CommentaireType;
    use Pizz\SiteBundle\Form\ContactType;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\Httpfoundation\Response;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Intl\ResourceBundle\Util\ArrayAccessibleResourceBundle;

    class SiteController extends Controller
    {
        public function indexAction(Request $request)
        {
            $session = $request->getSession();

            if($session->get('panier') < 0)
            {
                $pizza = array();
                $session->set('panier', 0);
                $session->set('pizza',$pizza);
            }

            return $this->render('PizzSiteBundle:Site:index.html.twig');
        }

        public function pizzaAction()
        {
            $pizz = $this->getDoctrine()
                ->getManager()
                ->getRepository('PizzAdminBundle:Pizza')
                ->findAll();

            return $this->render('PizzSiteBundle:Site:pizza.html.twig', array(
                'pizza' => $pizz
            ));
        }

        public function crafterAction(Request $request)
        {
            $session = $request->getSession();

            if ($request->getMethod() == 'POST')
            {
                $prix = 0.0;
                $ingredients = "";

                foreach($_POST as $key => $value)
                {
                    if($key == "fondpizz")
                    {
                        $prix+=floatval(6);
                        $ingredients .= $value;
                        $ingredients .= ", ";
                    }
                    else
                    {
                        $prix+=floatval($value);
                        $ingredients .= $key;
                        $ingredients .= ", ";
                    }
                }

                if(is_array($session->get('pizza')))
                {
                    //Ajout de la pizza dans la commande
                    $commande = $session->get('pizza');
                }
                else
                {
                    $commande = [];
                }

                array_push($commande,["Pizza Craftee",$prix,$ingredients]);
                $session->set('pizza',$commande);

                //Ajout d'une de plus dans le panier
                $nb = $session->get('panier');
                $nb++;
                $session->set('panier',$nb);

                $this->get('session')->getFlashBag()->add('info', 'Pizza Craftée ajouté au Panier');


            }

            $ingredients = $this->getDoctrine()
                ->getManager()
                ->getRepository('PizzAdminBundle:Ingredient')
                ->findAll();

            return $this->render('PizzSiteBundle:Site:crafter.html.twig',array(
                'ingredients' => $ingredients
            ));
        }

        public function livreAction($page)
        {
            $commentaire = new Commentaire;
            $form = $this->createForm(new CommentaireType, $commentaire);

            $request = $this->getRequest();

            // On vérifie qu'elle est de type POST
            if ($request->getMethod() == 'POST') {
                // On fait le lien Requête <-> Formulaire
                $form->bind($request);

                // On vérifie que les valeurs entrées sont correctes
                // (Nous verrons la validation des objets en détail dans le prochain chapitre)
                if ($form->isValid())
                {
                    // On enregistre notre objet $article dans la base de données
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($commentaire);
                    $em->flush();

                    // On définit un message flash
                    $this->get('session')->getFlashBag()->add('info', 'Article bien ajouté');

                    // On redirige vers la page de visualisation de l'article nouvellement créé
                    return $this->redirect($this->generateUrl('site_livre'));
                }
            }

            $com = $this->getDoctrine()
                ->getManager()
                ->getRepository('PizzSiteBundle:Commentaire')
                ->findAll();

            return $this->render('PizzSiteBundle:Site:livre.html.twig', array(
                'form' => $form->createView(),
                'com' => $com,
                'page' => $page,
                'nombrePage' => ceil(count($com)/10),
            ));
        }

        public function panierAction(Request $request)
        {
            $session = $request->getSession();

            $listePizza = $this->getDoctrine()
                ->getManager()
                ->getRepository('PizzAdminBundle:Pizza')
                ->findAll();

            if($request->getMethod() == 'POST')
            {
                return $this->redirect($this->generateUrl('site_commander'));
            }


            return $this->render('PizzSiteBundle:Site:panier.html.twig',array(
                'commande' => $session->get('pizza'),
                'pizza' => $listePizza
            ));
        }

        public function ajouterAction(Request $request,$id)
        {
            $session = $request->getSession();

            if($request->getMethod() == 'POST')
            {
                //Ajout de la pizza dans la commande
                if(is_array($session->get('pizza')))
                {
                    //Ajout de la pizza dans la commande
                    $commande = $session->get('pizza');
                }
                else
                {
                    $commande = [];
                }
                array_push($commande,["Pizza Menu",$id]);
                $session->set('pizza',$commande);

                //Ajout d'une de plus dans le panier
                $nb = $session->get('panier');
                $nb++;
                $session->set('panier',$nb);

                $this->get('session')->getFlashBag()->add('info', 'Pizza bien ajoutée au Panier');
            }

            return $this->redirect($this->generateUrl('site_pizza'));
        }

        public function supprimerAction(Request $request,$id)
        {
            $session = $request->getSession();

            if($request->getMethod() == 'POST')
            {
                //Ajout de la pizza dans la commande
                $commande = $session->get('pizza');
                unset($commande[$id]);
                $commande = array_values($commande);
                $session->set('pizza',$commande);

                $nb = $session->get('panier');
                $nb--;
                $session->set('panier',$nb);

                $this->get('session')->getFlashBag()->add('info', 'Pizza supprimée');
            }

            return $this->redirect($this->generateUrl('site_panier'));
        }

        public function contactAction(Request $request)
        {
            $contact = new Contact;
            $form = $this->createForm(new ContactType, $contact);

            if ($request->getMethod() == 'POST')
            {
                $form->bind($request);

                if ($form->isValid())
                {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($contact);
                    $em->flush();

                    return $this->redirect($this->generateUrl('site_accueil'));
                }
            }

            return $this->render('PizzSiteBundle:Site:contact.html.twig',array(
                'form' => $form->createView(),
            ));
        }

        public function commanderAction(Request $request)
        {
            $session = $request->getSession();

            $cb = new CB;
            $form = $this->createForm(new CBType, $cb);

            $listePizza = $this->getDoctrine()
                ->getManager()
                ->getRepository('PizzAdminBundle:Pizza')
                ->findAll();

            if($request->getMethod() == 'POST')
            {
                $commande = $session->get('pizza');
                $nb = $session->get('panier');

                foreach($commande as $value => $id)
                {
                    unset($commande[$value]);
                    $nb--;
                }

                $commande = array_values($commande);
                $session->set('pizza',$commande);
                $session->set('panier',$nb);

                return $this->redirect($this->generateUrl('site_accueil'));
            }

            return $this->render('PizzSiteBundle:Site:facture.html.twig',array(
                'commande' => $session->get('pizza'),
                'pizza' => $listePizza,
                'form' => $form->createView()
            ));
        }
    }