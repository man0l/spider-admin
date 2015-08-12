<?php

namespace Ebay\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;


class Builder
{
    public function createMainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', array(
            'navbar' => true,           
        ));
        
        $menu->setChildrenAttribute('class', 'nav navbar-nav');

        $layout = $menu->addChild('Items list', array(
            'icon' => 'home',
            'route' => 'admin_item',
        ));
 

        $menu->addChild('Amazon Items', array(
            'route' => 'admin_amazon_item'
        ));
        
        return $menu;
    }
    
}