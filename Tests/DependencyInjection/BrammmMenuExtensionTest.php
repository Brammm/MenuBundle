<?php

namespace Brammm\MenuBundle\Tests\DependencyInjection;

use Brammm\MenuBundle\DependencyInjection\BrammmMenuExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class BrammmMenuExtensionTest extends \PHPUnit_Framework_TestCase
{

    /** @var BrammmMenuExtension */
    private $SUT;
    /** @var ContainerBuilder */
    private $container;

    public function setUp()
    {
        $this->SUT       = new BrammmMenuExtension();
        $this->container = new ContainerBuilder();
    }

    public function testHasThemeConfig()
    {
        $this->SUT->load([], $this->container);

        $this->assertTrue($this->container->hasParameter('brammm_menu.theme'));
    }

    public function testHasServices()
    {
        $this->SUT->load([], $this->container);

        $this->assertTrue($this->container->hasDefinition('brammm_menu.twig.extension.menu'));
        $this->assertTrue($this->container->hasDefinition('brammm_menu.menu_provider'));
        $this->assertTrue($this->container->hasDefinition('brammm_menu.menu_renderer'));

    }

} 