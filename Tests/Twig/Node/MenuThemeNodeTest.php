<?php

namespace Brammm\MenuBundle\Tests\Twig\Node;

use Brammm\MenuBundle\Twig\Node\MenuThemeNode;

class MenuThemeNodeTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $menu  = new \Twig_Node_Expression_Name('menu', 0);
        $theme = new \Twig_Node_Expression_Constant('tpl1', 0);

        $node = new MenuThemeNode($menu, $theme, 0);

        $this->assertEquals($menu, $node->getNode('menuItem'));
        $this->assertEquals($theme, $node->getNode('template'));
    }

    public function testCompile()
    {
        $menu  = new \Twig_Node_Expression_Name('menu', 0);
        $theme = new \Twig_Node_Expression_Constant('tpl1', 0);

        $node = new MenuThemeNode($menu, $theme, 0);

        $compiler = new \Twig_Compiler(new \Twig_Environment());

        $this->assertEquals(
            sprintf(
                '$this->env->getExtension(\'brammm_menu\')->renderer->setTheme(%s, "tpl1");',
                $this->getVariableGetter('menu')
            ),
            trim($compiler->compile($node)->getSource())
        );
    }

    /**
     * See FormThemeNode
     *
     * @param $name
     *
     * @return string
     */
    protected function getVariableGetter($name)
    {
        if (version_compare(phpversion(), '5.4.0RC1', '>=')) {
            return sprintf('(isset($context["%s"]) ? $context["%s"] : null)', $name, $name);
        }

        return sprintf('$this->getContext($context, "%s")', $name);
    }
}
