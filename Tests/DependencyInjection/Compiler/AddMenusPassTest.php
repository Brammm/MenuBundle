<?php

namespace Brammm\MenuBundle\Tests\DependencyInjection\Compiler;

use Brammm\MenuBundle\DependencyInjection\Compiler\AddMenusPass;
use Symfony\Component\DependencyInjection\Reference;

class AddMenusPassTest extends \PHPUnit_Framework_TestCase
{
    public function testTaggedMenusGetAddedToProvider()
    {
        $container = $this->getContainerMock();

        $addCacheWarmerPass = new AddMenusPass();
        $addCacheWarmerPass->process($container);
    }

    private function getDefinitionMock()
    {
        $definition = $this->getMock('Symfony\Component\DependencyInjection\Definition');
        $definition->expects($this->once())
            ->method('addMethodCall')
            ->with('addMenu', [
                new Reference('menu_service'),
            ]);
        return $definition;
    }

    private function getContainerMock()
    {
        $container = $this->getMock('Symfony\Component\DependencyInjection\ContainerBuilder');

        $container->expects($this->atLeastOnce())
            ->method('findTaggedServiceIds')
            ->with('brammm_menu.menu')
            ->will($this->returnValue(['menu_service' => []]));
        $container->expects($this->atLeastOnce())
            ->method('getDefinition')
            ->with('brammm_menu.menu_provider')
            ->will($this->returnValue($this->getDefinitionMock()));

        return $container;
    }
}
