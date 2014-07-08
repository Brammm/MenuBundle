<?php

class MenuItemTest extends \PHPUnit_Framework_TestCase
{

    public function testCantHaveUndeclaredOptions()
    {
        $menuItem = new \Brammm\MenuBundle\Menu\MenuItem('foo', [], ['foo' => 'bar']);
    }

//    public function testCanHaveOptions()
//    {
//
//    }
} 