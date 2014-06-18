<?php

namespace Brammm\MenuBundle\Twig;

use Brammm\MenuBundle\Menu\MenuRenderer;

class MenuExtension extends \Twig_Extension
{

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        $renderer = new MenuRenderer();

        return [
            new \Twig_SimpleFunction('hello_world', [$renderer, 'render']),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'brammm_menu';
    }
}