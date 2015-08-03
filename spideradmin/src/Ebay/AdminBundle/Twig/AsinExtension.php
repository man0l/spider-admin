<?php

namespace Ebay\AdminBundle\Twig;

class AsinExtension extends \Twig_Extension
{
    public function getFilters()
    {
        parent::getFilters();
        return array(
            new \Twig_SimpleFilter('split_asin', array($this, 'asinFilter')),
        );
    }
    
    
    public function asinFilter($asin)
    {
        
        $format = '<a href="http://www.amazon.com/dp/%1$s" title="view details about %1$s">%s</a>';
        $format .= "\n";
        $output = "";
        
        if(false !== strpos($asin,","))
        {
            $asins[] = explode(",", $asin);
            foreach($asins[0] as $a)
            {
                 
                $output .= sprintf($format, $a);
                
            }
        } else {
            $output = sprintf($format, $asin);
        }
        
        $output = nl2br($output);
        
        return $output;
        
    }
    
    public function getName()
    {
        return 'asin_extension';
    } 
           
}