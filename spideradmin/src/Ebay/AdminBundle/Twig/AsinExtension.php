<?php

namespace Ebay\AdminBundle\Twig;

class AsinExtension extends \Twig_Extension
{
    public function getFilters()
    {
        parent::getFilters();
        return array(
            new \Twig_SimpleFilter('split_asin', array($this, 'asinFilter')),
            new \Twig_SimpleFilter('asin_options', array($this, 'asinOptions'))
        );
    }
    
    
    public function asinFilter($asin)
    {
        
        $format = '<a href="http://www.amazon.com/dp/%1$s" title="view details about %1$s" target="_blank">%s</a>';
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
    
    public function asinOptions($asin, $id, $mainAsin = "") {
        
        $output = sprintf('<select name="asin_options[]" id="asin_options_%s" data-id="%1$s">', $id);
        $output .= "<option value=''>Choose main ASIN</option>";
        $format = '<option value="%s" %s>%1$s</option>';
        
        if(false !== strpos($asin,","))
        {
            $asins[] = explode(",", $asin);
            foreach($asins[0] as $a)
            {
                if(!empty($a) && $mainAsin == $a)
                {
                    $selected = "selected='selected'";
                } else $selected = "";
                
                $output .= sprintf($format, $a, $selected);               
                
            }
        } else {
             if(!empty($asin) &&  $mainAsin == $asin)
             {
                    $selected = "selected='selected'";
                    $output .= sprintf($format, $asin, $selected);

             }  else {
                 $output = sprintf('<input type="text" name="asin_options[]" value="%s" id="asin_options_%s" data-id="%1$s">', $mainAsin, $id);
             }
                
            
        }
        
        if(strpos('input', $output) !== false) 
        {
            $output .= "</select>";
        }
        
        return $output;
    }
    
    public function getName()
    {
        return 'asin_extension';
    } 
           
}