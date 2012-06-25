<?php

namespace VZ\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use VZ\CalendarBundle\Entity\User;

/**
 * User controller - user administration
 *
 *
 * @Route("/admin/user")
 */
class UserController extends Controller
{
    /**
     * List all users
     *
     * @Route("/", name="vz_calendar_user_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $users  = $em->getRepository('VZCalendarBundle:User')->findAll();

        return array(
            'users' => $users
        );
    }
}
