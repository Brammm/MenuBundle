<?php

namespace Brammm\MenuBundle\Menu;

interface BuilderInterface
{
    /**
     * Create a new MenuItem and return it
     *
     * @return MenuItem
     */
    public function buildMenu();

}