<?php

namespace Brammm\MenuBundle\Provider;

use Brammm\MenuBundle\Menu\BuilderInterface;

/**
 * Stores and provides menus
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class MenuProvider
{
    /** @var array */
    private $menus;

    /**
     * @param BuilderInterface $builder
     *
     * @return $this
     */
    public function addMenu(BuilderInterface $builder)
    {
        $menu = $builder->buildMenu();
        $this->menus[$menu->getName()] = $menu;

        return $this;
    }

    /**
     * @param string $name
     */
    public function getMenu($name)
    {
        return $this->menus[$name];
    }
} 