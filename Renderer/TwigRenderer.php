<?php

namespace Brammm\MenuBundle\Renderer;

use Brammm\MenuBundle\Menu\Item;

/**
 * Renders blocks from a template.
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class TwigRenderer implements RendererInterface
{

    /** @var \Twig_Environment */
    private $environment;
    /** @var string */
    private $defaultTheme;
    /** @var array */
    private $themes;

    /**
     * @param \Twig_Environment $environment
     * @param string            $defaultTheme
     */
    public function __construct(\Twig_Environment $environment, $defaultTheme)
    {
        $this->environment  = $environment;
        $this->defaultTheme = $defaultTheme;
    }

    /**
     * {@inheritDoc}
     */
    public function setTheme(Item $menuItem, $theme)
    {
        $this->themes[$menuItem->getName()] = $theme;
    }

    /**
     * {@inheritDoc}
     */
    public function renderMenu(Item $item)
    {
        return $this->renderBlock('menu', $item);
    }

    /**
     * {@inheritDoc}
     */
    public function renderItem(Item $item)
    {
        return $this->renderBlock('menu_item', $item);
    }

    /**
     * Renders a block from a template
     *
     * @param string   $block
     * @param Item $item
     *
     * @return string
     */
    private function renderBlock($block, Item $item)
    {
        return $this
            ->getTemplate($this->getThemeForItem($item))
            ->renderBlock($block, ['item' => $item]);
    }

    /**
     * Get the theme for a specific Item
     * Sees if the Item itself has a theme set
     * or one of it's parents
     *
     * @param Item $item
     *
     * @return \Twig_Template
     */
    private function getThemeForItem(Item $item)
    {
        do {
            if (isset($this->themes[$item->getName()])) {
                return $this->themes[$item->getName()];
            }
        } while ($item = $item->getParent());

        return $this->defaultTheme;
    }

    /**
     * Gets a Twig template based on the theme
     *
     * @param $theme
     *
     * @return \Twig_Template
     */
    private function getTemplate($theme)
    {
        return $this->environment->loadTemplate($theme);
    }
}
