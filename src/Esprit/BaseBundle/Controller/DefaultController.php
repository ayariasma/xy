<?php

namespace Esprit\BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritBaseBundle:Default:index.html.twig');
    }
}
