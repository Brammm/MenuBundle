<?php

namespace Brammm\MenuBundle\Renderer;

use Brammm\MenuBundle\Menu\MenuItem;

class Renderer implements RendererInterface
{

    /** @var \Twig_Environment */
    private $environment;
    /** @var \Twig_Template */
    private $theme;

    public function __construct(\Twig_Environment $environment, $theme)
    {
        // Use setter because probably string
        $this->environment = $environment;

        $this->setTheme($theme);
    }

    public function renderMenu(MenuItem $item)
    {
        return $this->renderBlock('menu', ['item' => $item]);
    }

    public function renderItem(MenuItem $item)
    {
        return $this->renderBlock('menu_item', ['item' => $item]);
    }

    public function renderLink(MenuItem $item)
    {
        return $this->renderBlock('menu_link', ['item' => $item]);
    }

    public function renderBlock($block, $data = [])
    {
        $template = $this->environment->loadTemplate($this->theme);
        return $template->renderBlock($block, $data);
    }

    /**
     * @param \Twig_Template|string $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
//        if ($theme instanceof \Twig_Template) {
//            $this->theme = $theme;
//            return $this;
//        }
//
//        if (is_string($theme)) {
//            $this->theme = $this->environment->loadTemplate($theme);
//            return $this;
//        }
//
//        throw new \InvalidArgumentException(sprintf(
//                '$theme must be string or instance of Twig_Template, is %s.',
//                gettype($theme)
//            ));
    }
} 