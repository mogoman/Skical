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
 * Calendar controller - all event views and control
 *
 * new:    create new event
 * edit:   edit existing event
 * delete: delete an event
 *
 * @Route("/event")
 */
class EventController extends Controller
{
    /**
     * List out events
     *
     * @Route("/", name="vz_calendar_event_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events  = $em->getRepository('VZCalendarBundle:Event')
            ->findAll();

        return array(
            'events' => $events
        );
    }
    /**
     * Generate and display form for a new event
     *
     * @Route("/create", name="vz_calendar_event_create")
     * @param Request $request
     * @Template("VZCalendarBundle:Event:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $event   = new Event();

        $form = $this->createForm(new EventType(), $event);

        return array(
            'form'   => $form->createView()
        );
    }
    /**
     * Creates a new event (the createAction above posts the form to this route) by accepting the POSTed form
     * and creating the item in the database
     *
     * @Route("/new", name="vz_calendar_event_new")
     * @Method("post")
     * @Template()
     */
    public function newAction(Request $request)
    {
        $event   = new Event();

        $form    = $this->createForm(new EventType(), $event);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                // set some initial data fields
                $event->setUsedSlots(0);

                // persist and save to the database
                $em->persist($event);
                $em->flush();

                return $this->redirect($this->generateUrl('vz_calendar_event_index'));

            }
        }

        return array(
            'form'   => $form->createView()
        );
    }
    /**
     * Edit event
     *
     * @Route("/{id}/edit", name="vz_calendar_event_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }
        $form = $this->createForm(new EventType(), $event);

        return array(
            'event'       => $event,
            'form'        => $form->createView()
        );
    }
    /**
     * Update event - takes post data from form to update an existing event
     *
     * @Route("/{id}/update", name="vz_calendar_event_update")
     * @Method("post")
     * @Template()
     */
    public function updateAction(Request $request, $id)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }
        $form = $this->createForm(new EventType(), $event);

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($event);
                $em->flush();

                return $this->redirect($this->generateUrl('vz_calendar_event_edit', array('id' => $id)));
            }
        }
        return $this->render(
            'VZCalendarBundle:Event:edit.html.twig', array('form' => $form, 'event' => $event)
        );
    }
    /**
     * Delete event
     *
     * @Route("/{id}/delete", name="vz_calendar_event_delete")
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em    = $this->getDoctrine()->getManager();

        $event = $em->getRepository('VZCalendarBundle:Event')->find($id);

        if (!$event) {
            throw $this->createNotFoundException('event_notfound');
        }
        // delete this event @TODO
    }
}