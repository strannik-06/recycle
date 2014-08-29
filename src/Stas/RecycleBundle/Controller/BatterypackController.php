<?php

namespace Stas\RecycleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BatterypackController
 */
class BatterypackController extends Controller
{
    public function newAction()
    {
        return $this->render('StasRecycleBundle:Batterypack:new.html.twig');
    }
}
