<?php

namespace VZ\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use VZ\CalendarBundle\Entity\EventUser;
use VZ\CalendarBundle\Form\EventUserType;

/**
 * Attendance controller - all event attendance. Open to all logged in users
 *
 *
 * @Route("/attendance")
 */
class EventUserController extends Controller
{
    /**
     * make the form for joining an event
     *
     * @Route("/{eventId}/join", name="vz_calendar_eventuser_create")
     * @Template("VZCalendarBundle:EventUser:new.html.twig")
     */
    public function createAction(Request $request, $eventId)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }

        $eventUser = new EventUser();
        $eventUser->setEvent($event);
        $eventUser->setUser($this->get('security.context')->getToken()->getUser());

        $form = $this->createForm(new EventUserType(), $eventUser);

        return array(
            'event'       => $event,
            'form'        => $form->createView()
        );
    }
    /**
     * Process the form for joining an event
     *
     * @Route("/{eventId}/new", name="vz_calendar_eventuser_new")
     * @Method("post")
     * @Template()
     */
    public function newAction(Request $request, $eventId)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }

        $eventUser = new EventUser();
        $eventUser->setUser($this->get('security.context')->getToken()->getUser());

        $form = $this->createForm(new EventUserType(), $eventUser);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            $saveValid = true;

            if ($form->isValid()) {
                // add user to event
                if ($event->addEventUser($eventUser) === false) {
                    $saveValid = false;
                    // set form error
                    $form->addError(new FormError('not_enough_free_slots'));
                }

            }

            if ($saveValid) {
                $em = $this->getDoctrine()->getManager();

                // setup the link to the event
                $eventUser->setEvent($event);

                // setup the link to the user (note we are forcing here, for security reasons)
                $eventUser->setUser($this->get('security.context')->getToken()->getUser());

                // persist and save to the database
                $em->persist($eventUser);
                $em->flush();

                return $this->redirect($this->generateUrl('vz_calendar_index_index'));
            }
        }

        return array(
            'form'   => $form->createView(),
            'event'  => $event
        );
    }
    /**
     * Leave an event (currently logged in user)
     *
     * @Route("/{eventId}/leave", name="vz_calendar_eventuser_delete")
     * @Template()
     */
    public function leaveAction(Request $request, $eventId)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($eventId);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }

        if ($event->removeAttendee($this->get('security.context')->getToken()->getUser())) {
            $em->flush();
        }
        return $this->redirect($this->generateUrl('vz_calendar_index_index'));
    }
}