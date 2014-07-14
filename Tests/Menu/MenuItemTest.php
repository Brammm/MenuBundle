<?php

namespace Brammm\MenuBundle\Tests\Menu;

use Brammm\MenuBundle\Menu\MenuItem;

class MenuItemTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testCantHaveUndeclaredOptions()
    {
        new MenuItem('foo', [], ['foo' => 'bar']);
    }

    public function testHasName()
    {
        $SUT = new MenuItem('foo');

        $this->assertEquals('foo', $SUT->getName());
    }

    public function hasDefaultPathAndUri()
    {
        $SUT = new MenuItem('foo');

        $this->assertNull($SUT->path);
        $this->assertNull($SUT->uri);
    }

    public function testCanHaveDefaultOptions()
    {
        $SUT = new MenuItem('foo', ['foo' => 'bar']);

        $this->assertEquals('bar', $SUT->foo);
    }

    public function testCanHaveOptions()
    {
        $SUT = new MenuItem('foo', ['foo' => 'bar'], ['foo' => 'baz']);

        $this->assertEquals('baz', $SUT->foo);
    }

    public function testCanAddChild()
    {
        $SUT = new MenuItem('foo');

        $SUT->addChild('bar');

        $this->assertCount(1, $SUT->getChildren());
    }

    public function testCanCheckForChildren()
    {
        $SUT = new MenuItem('foo');

        $SUT->addChild('bar');

        $this->assertTrue($SUT->hasChildren());
    }

    public function testParentIsSet()
    {
        $SUT = new MenuItem('foo');

        $child = $SUT->addChild('bar');

        $this->assertEquals($SUT, $child->getParent());
        $this->assertEquals($SUT, $child->end());
    }

    public function testHasIncreasingLevel()
    {
        $parent   = new MenuItem('parent');
        $child    = $parent->addChild('child');
        $subChild = $child->addChild('subchild');

        $this->assertEquals(0, $parent->getLevel());
        $this->assertEquals(1, $child->getLevel());
        $this->assertEquals(2, $subChild->getLevel());
    }

    public function testCanCheckForRoot()
    {
        $parent = new MenuItem('parent');
        $child  = $parent->addChild('child');

        $this->assertTrue($parent->isRoot());
        $this->assertFalse($child->isRoot());
    }
}
