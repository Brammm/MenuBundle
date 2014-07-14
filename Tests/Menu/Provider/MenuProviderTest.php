<?php

namespace Brammm\MenuBundle\Tests\Menu\Provider;

use Brammm\MenuBundle\Menu\Provider\MenuProvider;

class MenuProviderTest extends \PHPUnit_Framework_TestCase
{
    /** @var MenuProvider */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new MenuProvider();
    }

    public function testCanAddAndGetMenu()
    {
        $this->addMenu();

        $this->assertInstanceOf('Brammm\MenuBundle\Menu\Menu', $this->SUT->getMenu('foo'));
    }

    private function addMenu()
    {
        $menuBuilder = $this->getMock('Brammm\MenuBundle\Menu\Builder\BuilderInterface');

        $menuBuilder->expects($this->once())
            ->method('setDefaultOptions');
        $menuBuilder->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('foo'));

        $menuBuilder->expects($this->once())
            ->method('buildMenu');

        $this->SUT->addMenu($menuBuilder);
    }
} 