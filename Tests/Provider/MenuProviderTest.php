<?php

namespace Brammm\MenuBundle\Tests\Provider;

use Brammm\MenuBundle\Provider\MenuProvider;

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

        $this->assertInstanceOf('Brammm\MenuBundle\Menu\MenuItem', $this->SUT->getMenu('foo'));
    }

    private function addMenu()
    {
        $menuBuilder = $this->getMock('Brammm\MenuBundle\Menu\BuilderInterface');
        $menuItem    = $this->getMockBuilder('Brammm\MenuBundle\Menu\MenuItem')
            ->disableOriginalConstructor()
            ->getMock();

        $menuItem->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('foo'));

        $menuBuilder->expects($this->once())
            ->method('buildMenu')
            ->will($this->returnValue($menuItem));

        $this->SUT->addMenu($menuBuilder);
    }
} 