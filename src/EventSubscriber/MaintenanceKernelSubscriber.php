<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceKernelSubscriber implements EventSubscriberInterface
{
    private $displayMaintenanceMessage;
    private $maintenanceMessage; 

    public function __construct($displayMaintenanceMessage)
    {
        $this->displayMaintenanceMessage = $displayMaintenanceMessage[0];
        $this->maintenanceMessage = $displayMaintenanceMessage[1]; 
     
    }

    public function onResponseEvent(ResponseEvent $event)
    { 

        if(!$this->displayMaintenanceMessage) {
            return;
        }

        $response = $event->getResponse();
        $content = $response->getContent();

        $content = str_replace(
            "<body>", 
            "<body><div class=\"maintenance-message\">Maintenance prévue " .$this->maintenanceMessage . "</div>", 
            $content
        );
        
        $response->setContent($content);
    }

    public static function getSubscribedEvents()
    {
        return [
            ResponseEvent::class => 'onResponseEvent',
        ];
    }
}