<?php

namespace Brammm\MenuBundle;

use Brammm\MenuBundle\DependencyInjection\Compiler\AddMenusPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BrammmMenuBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddMenusPass());
    }
}
