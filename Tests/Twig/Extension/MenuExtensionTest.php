<?php

namespace Brammm\MenuBundle\Tests\Twig\Extension;

use Brammm\MenuBundle\Twig\Extension\MenuExtension;

class MenuExtensionTest extends \PHPUnit_Framework_TestCase
{

    /** @var MenuExtension */
    private $SUT;

    public function setUp()
    {
        $renderer = $this->getMock('Brammm\MenuBundle\Renderer\RendererInterface');

        $this->SUT = new MenuExtension($renderer);
    }

    public function testHasName()
    {
        $this->assertEquals('brammm_menu', $this->SUT->getName());
    }

    public function testRegistersFunctions()
    {
        $functions = $this->SUT->getFunctions();

        $names = [];
        foreach ($functions as $function) {
            $names[] = $function->getName();
        }

        $this->assertTrue(in_array('brammm_menu', $names));
        $this->assertTrue(in_array('menu_item', $names));
    }

    public function testHasTokenParser()
    {
        $parsers = $this->SUT->getTokenParsers();

        $tags = [];
        foreach ($parsers as $parser) {
            $tags[] = $parser->getTag();
        }

        $this->assertTrue(in_array('menu_theme', $tags));
    }
}
