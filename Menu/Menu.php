<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Menu
{
    /** @var string */
    private $name;
    /** @var Item[] */
    private $children;
    /** @var OptionsResolverInterface */
    private $resolver;

    public function __construct($name, OptionsResolverInterface $resolver)
    {
        $this->name     = $name;
        $this->resolver = $resolver;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Item[]
     */
    public function getChildren()
    {
        return $this->$children;
    }

    /**
     * @param $name
     * @param $options
     *
     * @return Item
     */
    public function addChild($name, $options)
    {
        $item = new Item($name, $this->resolver, $options, 0, count($this->children), null);
        $this->children[] = $item;
        return $item;
    }

}
 