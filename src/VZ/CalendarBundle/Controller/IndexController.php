<?php

namespace VZ\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

/**
 * Calendar controller - all calendar views
 *
 * @Route("/")
 */
class IndexController extends Controller
{
    /**
     * @Route("", name="vz_calendar_index_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em     = $this->getDoctrine()->getManager();

        $events = $em->getRepository('VZCalendarBundle:Event')->findAllCurrent();

        return array(
            'events' => $events
        );
    }
}