<?php

namespace Brammm\MenuBundle\Menu;

class Menu 
{
    /** @var string */
    private $name;
    /** @var Item[] */
    private $items;
    /** @var int */
    private $level;

    public function __construct($name, $level) {
        $this->name  = $name;
        $this->level = $level;
    }

    /**
     * @return Item[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

}
 