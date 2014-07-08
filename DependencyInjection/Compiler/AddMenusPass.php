<?php

namespace Brammm\MenuBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Add tagged menus to the provider
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class AddMenusPass implements CompilerPassInterface
{

    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        $menuProvider = $container->getDefinition('brammm_menu.menu_provider');
        $menus        = $container->findTaggedServiceIds('brammm_menu.menu');

        foreach (array_keys($menus) as $serviceId) {
            $menuProvider->addMethodCall('addMenu', [new Reference($serviceId)]);
        }
    }
}