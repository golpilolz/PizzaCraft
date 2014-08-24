<?php

namespace Pizz\ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Httpfoundation\Response;

class ClientController extends Controller
{
    public function indexAction()
    {
        return $this->render('PizzClientBundle:Client:index.html.twig');
    }

    public function historiqueAction()
    {
        return $this->render('PizzClientBundle:Client:historique.html.twig');
    }
}
