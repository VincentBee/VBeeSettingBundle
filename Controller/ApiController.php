<?php

namespace VBee\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function getAction(Request $request)
    {
        $settings = array();
        foreach ($this->get('vbee.manager.setting')->all() as $setting) {
            $settings[$setting->getName()] = $setting->getValue();
        }

        return new Response(
            json_encode(
                array(
                    'status' => array(
                        'code' => 200,
                        'message' => 'OK'
                    ),
                    'response' => array(
                        'settings' => $settings
                    ),
                )
            ),
            200,
            array(
                'Content-Type' => 'application/json'
            )
        );
    }
}
