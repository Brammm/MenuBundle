<?php

namespace Brammm\MenuBundle\Menu;

class MenuRenderer implements MenuRendererInterface
{

    private $theme = 'template!';
    private $twig;

    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = $twig;
    }


    public function render()
    {
        return $this->theme;
    }
} 