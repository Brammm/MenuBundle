<?php

namespace Brammm\MenuBundle\Tests\Twig\TokenParser;

use Brammm\MenuBundle\Twig\Node\MenuThemeNode;
use Brammm\MenuBundle\Twig\TokenParser\MenuThemeTokenParser;

class MenuThemeTokenParserTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider getTestsForMenuTheme
     */
    public function testCompile($source, $expected)
    {
        $env = new \Twig_Environment(new \Twig_Loader_String(), array('cache' => false, 'autoescape' => false, 'optimizations' => 0));
        $env->addTokenParser(new MenuThemeTokenParser());
        $stream = $env->tokenize($source);
        $parser = new \Twig_Parser($env);

        $this->assertEquals($expected, $parser->parse($stream)->getNode('body')->getNode(0));
    }

    public function getTestsForMenuTheme()
    {
        return array(
            array(
                '{% menu_theme menu "tpl1" %}',
                new MenuThemeNode(
                    new \Twig_Node_Expression_Name('menu', 1),
                    new \Twig_Node_Expression_Constant('tpl1', 1),
                    1,
                    'menu_theme'
                )
            ),
        );
    }
}
 