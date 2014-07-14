<?php

namespace Brammm\MenuBundle\Tests\Menu;

use Brammm\MenuBundle\Menu\Item;

class Test extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testCantHaveUndeclaredOptions()
    {
        new Item('foo', [], ['foo' => 'bar']);
    }

    public function testHasName()
    {
        $SUT = new Item('foo');

        $this->assertEquals('foo', $SUT->getName());
    }

    public function hasDefaultPathAndUri()
    {
        $SUT = new Item('foo');

        $this->assertNull($SUT->path);
        $this->assertNull($SUT->uri);
    }

    public function testCanHaveDefaultOptions()
    {
        $SUT = new Item('foo', ['foo' => 'bar']);

        $this->assertEquals('bar', $SUT->foo);
    }

    public function testCanHaveOptions()
    {
        $SUT = new Item('foo', ['foo' => 'bar'], ['foo' => 'baz']);

        $this->assertEquals('baz', $SUT->foo);
    }

    public function testCanAddChild()
    {
        $SUT = new Item('foo');

        $SUT->addChild('bar');

        $this->assertCount(1, $SUT->getChildren());
    }

    public function testCanCheckForChildren()
    {
        $SUT = new Item('foo');

        $SUT->addChild('bar');

        $this->assertTrue($SUT->hasChildren());
    }

    public function testParentIsSet()
    {
        $SUT = new Item('foo');

        $child = $SUT->addChild('bar');

        $this->assertEquals($SUT, $child->getParent());
        $this->assertEquals($SUT, $child->end());
    }

    public function testHasIncreasingLevel()
    {
        $parent   = new Item('parent');
        $child    = $parent->addChild('child');
        $subChild = $child->addChild('subchild');

        $this->assertEquals(null, $parent->getLevel());
        $this->assertEquals(0, $child->getLevel());
        $this->assertEquals(1, $subChild->getLevel());
    }

    public function testCanCheckForRoot()
    {
        $parent   = new Item('parent');
        $child    = $parent->addChild('child');
        $subChild = $child->addChild('subchild');

        $this->assertFalse($parent->isRoot());
        $this->assertTrue($child->isRoot());
        $this->assertFalse($subChild->isRoot());
    }
}
