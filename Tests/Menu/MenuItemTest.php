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

    }
} 