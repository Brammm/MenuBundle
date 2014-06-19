<?php

namespace Brammm\MenuBundle\Provider;

use Brammm\MenuBundle\Menu\BuilderInterface;

class MenuProvider
{
    /** @var array */
    private $menus;

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