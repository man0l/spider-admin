<?php

namespace Ebay\AdminBundle\Event;

use Ebay\AdminBundle\Event\UpdateAmazonEvent;

class UpdateAmazonSubscriber
{
    /**
     * this is our event listener method
     */
    public function onAmazonUpdate(UpdateAmazonEvent $event)
    {
        
        $items = $event->getItems();
        
        // process items here ( currently doctrine entities )
        
        // push them in a queue for example ( or Redis )
        
    }
}