<?php

namespace Brammm\MenuBundle\Tests\Menu;

use Brammm\MenuBundle\Menu\Item;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemTest extends \PHPUnit_Framework_TestCase
{

    /** @var \PHPUnit_Framework_MockObject_MockObject|OptionsResolverInterface  */
    private $resolver;

    public function setUp()
    {
        $this->resolver = $this->getMock('Symfony\Component\OptionsResolver\OptionsResolverInterface');
    }

    public function testHasName()
    {
        $SUT = new Item('foo', $this->resolver, [], 0, 0, null);

        $this->assertEquals('foo', $SUT->getName());
    }

    public function hasDefaultPathAndUri()
    {
        $SUT = new Item('foo', $this->resolver, [], 0, 0, null);

        $this->assertNull($SUT->path);
        $this->assertNull($SUT->uri);
    }

    public function testCanAddChild()
    {
        $SUT = new Item('foo', $this->resolver, [], 0, 0, null);

        $SUT->addChild('bar');

        $this->assertCount(1, $SUT->getChildren());
    }

    public function testCanCheckForChildren()
    {
        $SUT = new Item('foo', $this->resolver, [], 0, 0, null);

        $SUT->addChild('bar');

        $this->assertTrue($SUT->hasChildren());
    }

    public function testParentIsSet()
    {
        $SUT = new Item('foo', $this->resolver, [], 0, 0, null);

        $child = $SUT->addChild('bar');

        $this->assertEquals($SUT, $child->getParent());
        $this->assertEquals($SUT, $child->end());
    }

    public function testHasIncreasingLevel()
    {
        $parent   = new Item('parent', $this->resolver, [], 0, 0, null);
        $child    = $parent->addChild('child');
        $subChild = $child->addChild('subchild');

        $this->assertEquals(0, $parent->getLevel());
        $this->assertEquals(1, $child->getLevel());
        $this->assertEquals(2, $subChild->getLevel());
    }

    public function testCanCheckForRoot()
    {
        $parent   = new Item('parent', $this->resolver, [], 0, 0, null);
        $child    = $parent->addChild('child');

        $this->assertTrue($parent->isRoot());
        $this->assertFalse($child->isRoot());
    }
}
