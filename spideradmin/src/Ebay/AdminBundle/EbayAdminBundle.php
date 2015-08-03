<?php

namespace Ebay\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Ebay\AdminBundle\DependencyInjection\Compiler\SassPass;

class EbayAdminBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        //parent::build($container);
        $container->addCompilerPass(new SassPass());
    }
}
