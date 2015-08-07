<?php

namespace Ebay\AdminBundle\Event;

use Ebay\AdminBundle\Event\UpdateAmazonEvent;
use Snc\RedisBundle\Client\Predis;
use Predis\Client;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

class UpdateAmazonSubscriber
{
    
    private $redisKey;
    private $redisClient;
    private $logger;
    /**
     * this is our event listener method
     */
    public function onAmazonUpdate(UpdateAmazonEvent $event )
    {
        
        $items = $event->getItems();
        
        // process items here ( currently doctrine entities )
        
        // push them in a queue for example ( or Redis ) 
        $this->logger->debug("I am Event Listener!");
         
         foreach($items as $item)
         {
             if($item->getMainAsin())
             {
                $url = sprintf("http://www.amazon.com/dp/%s", $item->getMainAsin());
                $this->logger->debug("My url is: ".$url);
                $this->redisClient->rpush($this->redisKey?: 'amazon_spider:start_urls', $url);
             }
         }
    }
    
    
    public function setRedis(Client $redisClient)
    {
        $this->redisClient = $redisClient;
    }
    
    public function setRedisKey($redisKey) {
        $this->redisKey = $redisKey;
    }
    
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}