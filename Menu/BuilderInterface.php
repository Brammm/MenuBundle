<?php

namespace Brammm\MenuBundle\Menu;

/**
 * Interface for a MenuBuilder class
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
interface BuilderInterface
{
    /**
     * Create a new MenuItem and return it
     *
     * @return MenuItem
     */
    public function buildMenu();
}