<?php
namespace Ebay\AdminBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SassPass implements CompilerPassInterface {

    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition('assetic.filter.sass')) {
            $container->getDefinition('assetic.filter.sass')->addMethodCall('addLoadPath',
                array("%kernel.root_dir%/../vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/public/sass/")
                //array("%kernel.root_dir%/../web/bundles/mopabootstrap/sass/", "%kernel.root_dir%/../vendor/twbs/bootstrap-sass/assets/stylesheets/bootstrap/")
            );
        }
        if ($container->hasDefinition('assetic.filter.scss')) {
            $container->getDefinition('assetic.filter.scss')->addMethodCall('addLoadPath',
                array("%kernel.root_dir%/../vendor/mopa/bootstrap-bundle/Mopa/Bundle/BootstrapBundle/Resources/public/sass/")
                //array("%kernel.root_dir%/../web/bundles/mopabootstrap/sass/",  "%kernel.root_dir%/../vendor/twbs/bootstrap-sass/assets/stylesheets/bootstrap/")
            );
        }
    }
}
