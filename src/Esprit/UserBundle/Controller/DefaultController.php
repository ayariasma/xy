<?php

namespace Esprit\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritUserBundle:Default:index.html.twig');
    }
}
