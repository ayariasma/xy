<?php

namespace Esprit\MessageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EspritMessageBundle:Default:index.html.twig');
    }
}
