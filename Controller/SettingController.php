<?php

namespace VBee\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VBee\SettingBundle\Entity\Setting;

class SettingController extends Controller
{
    public function listAction(Request $request)
    {
        $settings = $this->get('vbee.manager.setting')->all();
        return $this->render('VBeeSettingBundle:Setting:list.html.twig', array(
            'settings' => $settings
        ));
    }

    public function createAction(Request $request)
    {
        $setting = new Setting();
        $formType = $this->get('vbee.form.setting');
        $form = $this->createForm($formType, $setting);

        if($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $this->get('vbee.manager.setting')->create($setting);
                return $this->redirect($this->generateUrl('vbee_setting_setting_list'));
            }
        }

        return $this->render('VBeeSettingBundle:Setting:form.html.twig', array(
            'form' => $form->createView(),
            'submit_path' => $this->generateUrl('vbee_setting_setting_create')
        ));
    }

    public function editAction(Request $request, $id)
    {
        $setting = $this->getDoctrine()->getRepository('VBeeSettingBundle:Setting')->find($id);

        $formType = $this->get('vbee.form.setting');
        $form = $this->createForm($formType, $setting);

        if($request->getMethod() === 'POST'){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();

                $em->flush();
                return $this->redirect($this->generateUrl('vbee_setting_setting_list'));
            }
        }

        return $this->render('VBeeSettingBundle:Setting:form.html.twig', array(
            'form' => $form->createView(),
            'submit_path' => $this->generateUrl('vbee_setting_setting_edit', array('id' => $id))
        ));
    }

    public function removeAction(Request $request, $id)
    {
        $setting = $this->getDoctrine()->getRepository('VBeeSettingBundle:Setting')->find($id);
        if($setting instanceof Setting){
            $em = $this->getDoctrine()->getManager();
            $em->remove($setting);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('vbee_setting_setting_list'));
    }
}
