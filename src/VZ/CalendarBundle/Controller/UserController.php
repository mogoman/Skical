<?php

namespace VZ\CalendarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use VZ\CalendarBundle\Entity\User;
use VZ\CalendarBundle\Form\AdminUserProfileType;

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
    /**
     * Edit given user
     *
     * @Route("/{id}/edit", name="vz_calendar_user_edit")
     * @Template()
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user  = $em->getRepository('VZCalendarBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('user_notfound');
        }
        $form = $this->createForm(new AdminUserProfileType('VZ\CalendarBundle\Entity\User'), $user);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();

                // persist and save to the database
                $em->persist($user);
                $em->flush();

                return $this->redirect($this->generateUrl('vz_calendar_user_index'));
            }
        }

        return array(
            'form' => $form->createView(),
            'user' => $user
        );
    }
    /**
     * Delete given user
     *
     * @Route("/{id}/delete", name="vz_calendar_user_delete")
     * @Template()
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user  = $em->getRepository('VZCalendarBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('user_notfound');
        }
        // cannot delete yourself
        if ($user->getId == $this->get('security.context')->getToken()->getUser()->getId()) {
            throw $this->createNotFoundException('user_cannotdeleteself');
        }
    }
    /**
     * Disable given user
     *
     * @Route("/{id}/disable", name="vz_calendar_user_disable")
     * @Template()
     */
    public function disableAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user  = $em->getRepository('VZCalendarBundle:User')->find($id);

        if (!$user) {
            throw $this->createNotFoundException('user_notfound');
        }
        // cannot delete yourself
        if ($user->getId() == $this->get('security.context')->getToken()->getUser()->getId()) {
            throw $this->createNotFoundException('user_cannotdisableself');
        }
        $user->setEnabled(0);

        // persist and save to the database
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('vz_calendar_user_index'));
    }
}