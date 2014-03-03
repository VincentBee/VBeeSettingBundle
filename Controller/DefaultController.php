<?php

namespace VBee\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VBeeSettingBundle:Default:index.html.twig', array('name' => $name));
    }
}
