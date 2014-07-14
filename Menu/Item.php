<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Representation of a Item
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class Item
{

    /** @var string */
    private $name;
    /** @var Item */
    private $parent;
    /** @var int */
    private $level;
    /** @var $index */
    private $index;
    /** @var Item[] */
    private $children;
    /** @var OptionsResolverInterface */
    private $resolver;

    /**
     * @param string                   $name
     * @param OptionsResolverInterface $resolver
     * @param array                    $options
     */
    public function __construct($name, OptionsResolverInterface $resolver, array $options = [], $level, $index, $parent)
    {
        $this->name   = $name;
        $this->level  = $level;
        $this->index  = $index;
        $this->parent = $parent;

        $this->resolver = $resolver;

        $options = $resolver->resolve($options);

        if (is_array($options)) {
            foreach ($options as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param string $label
     * @param array  $options
     *
     * @return Item
     */
    public function addChild($label, array $options = [])
    {
        $child = new Item($label, $this->resolver, $options, $this->level + 1, count($this->children), $this);
        $this->children[] = $child;

        return $child;
    }

    /**
     * Convenience method
     *
     * @return Item|null
     */
    public function end()
    {
        return $this->getParent();
    }

    ###########################
    #### SETTERS & GETTERS ####
    ###########################

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Item
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Item $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasChildren()
    {
        return count($this->children) > 0;
    }

    /**
     * @return Item[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * @param int $level
     *
     * @return $this
     */
    public function setLevel($level)
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        return 0 === $this->level;
    }

}
