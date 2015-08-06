<?php

namespace Ebay\AdminBundle\Event;

use Symfony\Component\EventDispatcher\Event;

class UpdateAmazonEvent extends Event
{
    private $items = array();
    
    public function __construct($items) {
        $this->items = $items;
    } 
    
    function getItems()
    {
        return $this->items;
    } 
        
}
    