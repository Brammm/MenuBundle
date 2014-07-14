<?php

namespace Brammm\MenuBundle\Renderer;

use Brammm\MenuBundle\Menu\Item;

/**
 * Renderer interface
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
interface RendererInterface
{

    /**
     * Set the theme for a specific Item
     *
     * @param Item $item
     * @param string   $theme
     */
    public function setTheme(Item $item, $theme);

    /**
     * Renders a full menu from the Item's children
     *
     * @param Item $item
     *
     * @return string
     */
    public function renderMenu(Item $item);

    /**
     * Renders a single Item
     *
     * @param Item $item
     *
     * @return string
     */
    public function renderItem(Item $item);
}
