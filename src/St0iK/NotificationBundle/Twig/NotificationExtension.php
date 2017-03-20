<?php

namespace St0iK\NotificationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NotificationExtension extends \Twig_Extension
{

    protected $container, $notify;

    public function __construct(ContainerInterface $container = null)
    {
        $this->container = $container;
        $this->notify = $container->get("stoik.notify");
    }
    public function getName()
    {
        return 'stoik_notification_extension';
    }

    public function getFunctions()
    {
        return array(
            new \Twig_Function(
                'notify_resources',
                array($this, 'renderResources'),
                array('is_safe' => array('html'))
            ),
            new \Twig_Function('render_all', array($this, 'renderAll')),
            new \Twig_Function('render_one', array($this, 'renderOne'))
        );
    }

    public function renderAll($container = false)
    {
        $notifications_array = $this->notify->all();

        if (count($notifications_array) > 0) {
            return $this->container->get('templating')
                ->render(
                    "@StoikNotification/Notification/multiple.html.twig",
                    compact("notifications_array", "container")
                );
        }

        return null;
    }

    public function renderOne($name, $container = false)
    {
        if (!$this->notify->has($name)) {
            return false;
        }
        $notifications = $this->notify->get($name);

        if (count($notifications) > 0) {
            return $this->container->get('templating')
                ->render(
                    "@StoikNotification/Notification/single.html.twig",
                    compact("notifications", "container")
                );
        }

        return null;
    }

    public function renderResources()
    {
        return $this->container->get('templating')
            ->render("@StoikNotification/Notification/resources.html.twig");
    }

}