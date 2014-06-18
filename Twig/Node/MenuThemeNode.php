<?php

namespace Brammm\MenuBundle\Twig\Node;

class MenuThemeNode extends \Twig_Node
{
    public function __construct(\Twig_NodeInterface $template, $lineno, $tag = null)
    {
        parent::__construct(array('template' => $template), array(), $lineno, $tag);
    }

    /**
     * Compiles the node to PHP.
     *
     * @param \Twig_Compiler $compiler A Twig_Compiler instance
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->addDebugInfo($this)
            ->write('$this->env->getExtension(\'brammm_menu\')->renderer->setTheme(')
            ->subcompile($this->getNode('template'))
            ->raw(");\n");
    }
}