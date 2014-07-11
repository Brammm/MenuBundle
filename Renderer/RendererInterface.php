<?php

namespace Brammm\MenuBundle\Renderer;

use Brammm\MenuBundle\Menu\MenuItem;

/**
 * Renderer interface
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
interface RendererInterface
{

    /**
     * Set the theme for a specific MenuItem
     *
     * @param MenuItem $item
     * @param string   $theme
     */
    public function setTheme(MenuItem $item, $theme);

    /**
     * Renders a full menu from the MenuItem's children
     *
     * @param MenuItem $item
     *
     * @return string
     */
    public function renderMenu(MenuItem $item);

    /**
     * Renders a single MenuItem
     *
     * @param MenuItem $item
     *
     * @return string
     */
    public function renderItem(MenuItem $item);
}
