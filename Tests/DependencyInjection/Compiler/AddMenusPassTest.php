<?php

namespace Brammm\MenuBundle\Tests\DependencyInjection\Compiler;

use Brammm\MenuBundle\DependencyInjection\Compiler\AddMenusPass;
use Symfony\Component\DependencyInjection\Reference;

class AddMenusPassTest extends \PHPUnit_Framework_TestCase
{
    public function testTaggedMenusGetAddedToProvider()
    {
        $services = array(
            'menu_service' => array(),
        );

        $definition = $this->getMock('Symfony\Component\DependencyInjection\Definition');
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $container->expects($this->atLeastOnce())
            ->method('findTaggedServiceIds')
            ->with('brammm_menu.menu')
            ->will($this->returnValue($services));
        $container->expects($this->atLeastOnce())
            ->method('getDefinition')
            ->with('brammm_menu.menu_provider')
            ->will($this->returnValue($definition));

        $definition->expects($this->once())
            ->method('addMethodCall')
            ->with('addMenu', [
                new Reference('menu_service'),
            ]);

        $addCacheWarmerPass = new AddMenusPass();
        $addCacheWarmerPass->process($container);
    }
}
