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

        $layout = $menu->addChild('Layout', array(
            'icon' => 'home',
            'route' => 'default_homepage',
        ));

        

        return $menu;
    }
    
}