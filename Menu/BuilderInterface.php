<?php

namespace Brammm\MenuBundle\Menu;

interface BuilderInterface
{
    /**
     * Create a new Menu and return it
     *
     * @return Menu
     */
    public function buildMenu();


} 