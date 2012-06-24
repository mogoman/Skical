<?php

namespace VZ\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use VZ\CalendarBundle\Entity\Event;
use VZ\CalendarBundle\Form\EventType;

/**
 * Attendance controller - all event attendance. Open to all logged in users
 *
 *
 * @Route("/attendance")
 */
class AttendanceController extends Controller
{
    /**
     * Join an event (currently logged in user) or update your attendance
     *
     * @Route("/join", name="vz_calendar_attendance_join")
     * @Template()
     */
    public function joinAction(Request $request)
    {
        return array(
        );
    }
    /**
     * Leave an event (currently logged in user)
     *
     * @Route("/leave", name="vz_calendar_attendance_leave")
     * @Template()
     */
    public function leaveAction(Request $request)
    {
        return array(
        );
    }
}