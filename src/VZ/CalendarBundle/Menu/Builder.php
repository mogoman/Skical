<?php
namespace VZ\CalendarBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Home', array('route' => 'vz_calendar_index_index'));
        $menu->addChild('User Profile', array('route' => 'fos_user_profile_edit'));
        $menu->addChild('Change Password', array('route' => 'fos_user_change_password'));
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        /*$menu->addChild('User Profile', array(
                    'route' => 'page_show',
                    'routeParameters' => array('id' => 42)
                ));
        */
        // ... add more children

        return $menu;
    }
    public function adminMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrentUri($this->container->get('request')->getRequestUri());

        $menu->addChild('Home', array('route' => 'vz_calendar_index_index'));
        $menu->addChild('User Profile', array('route' => 'fos_user_profile_edit'));
        $menu->addChild('Change Password', array('route' => 'fos_user_change_password'));
        $menu->addChild('Edit Events', array('route' => 'vz_calendar_event_index'));
        $menu->addChild('Edit Users', array('route' => 'vz_calendar_user_index'));
        $menu->addChild('Logout', array('route' => 'fos_user_security_logout'));
        /*$menu->addChild('User Profile', array(
                    'route' => 'page_show',
                    'routeParameters' => array('id' => 42)
                ));
        */
        // ... add more children

        return $menu;
    }
}