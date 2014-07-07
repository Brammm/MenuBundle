<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Traversable;

class MenuItem
{

    /** @var string */
    private $name;
    /** @var array */
    private $defaultOptions;
    /** @var MenuItem */
    private $parent;
    /** @var MenuItem[] */
    private $children;

    /**
     * @param string $name
     * @param array  $defaultOptions
     * @param array  $options
     */
    public function __construct($name, array $defaultOptions = [], array $options = [])
    {
        $this->name           = $name;
        $this->defaultOptions = $defaultOptions;

        $options = $this->getResolvedOptions($options);

        foreach ($options as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @param $label
     * @param $options
     *
     * @return MenuItem
     */
    public function addChild($label, $options)
    {
        $menu = new MenuItem($label, $this->defaultOptions, $options);
        $menu->setParent($this);
        $this->children[] = $menu;

        return $menu;
    }

    /**
     * Convenience method
     *
     * @return MenuItem|null
     */
    public function end()
    {
        return $this->getParent();
    }

    /**
     * @param array $options
     *
     * @return array
     */
    public function getResolvedOptions(array $options)
    {
        $this->defaultOptions += [
            'path' => null,
            'uri'  => null,
        ];

        $resolver = new OptionsResolver();
        $resolver->setDefaults($this->defaultOptions);

        return $resolver->resolve($options);
    }

    public function hasChildren()
    {
        return count($this) > 0;
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
     * @return MenuItem
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param MenuItem $parent
     *
     * @return $this
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return MenuItem[]
     */
    public function getChildren()
    {
        return $this->children;
    }


}