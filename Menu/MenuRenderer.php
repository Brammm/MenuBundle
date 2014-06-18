<?php

namespace Brammm\MenuBundle\Menu;

class MenuRenderer implements MenuRendererInterface
{

    private $theme;
    private $twig;

    public function __construct(\Twig_Environment $twig, $theme)
    {
        $this->twig  = $twig;
        $this->theme = $theme;
    }


    public function render()
    {
        return $this->theme;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
    }
} 