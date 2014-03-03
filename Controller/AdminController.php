<?php

namespace VBee\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VBee\SettingBundle\Entity\Setting;

class AdminController extends Controller
{
    public function listAction(Request $request)
    {
        $settings = $this->getDoctrine()->getRepository('VBeeSettingBundle:Setting')->findAll();
        return $this->render('VBeeSettingBundle:Admin:list.html.twig', array(
            'settings' => $settings
        ));
    }

    public function createAction(Request $request)
    {
        return $this->render('VBeeSettingBundle:Admin:create.html.twig', array());
    }

    public function editAction(Request $request, $id)
    {
        return $this->render('VBeeSettingBundle:Admin:create.html.twig', array());
    }

    public function removeAction(Request $request, $id)
    {
        $setting = $this->getDoctrine()->getRepository('VBeeSettingBundle:Setting')->find($id);
        if($setting instanceof Setting){
            $em = $this->getDoctrine()->getManager();
            $em->remove($setting);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('vbee_setting_admin_list'));
    }
}
