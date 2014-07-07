<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Traversable;

class MenuItem implements \IteratorAggregate, \Countable
{

    /** @var string */
    private $name;
    /** @var array */
    private $defaultOptions;
    /** @var string */
    private $uri;
    /** @var string */
    private $path;
    /** @var MenuItem */
    private $parent;
    /** @var MenuItem[] */
    private $children;

    /**
     * @param string $name
     * @param array  $defaultOptions
     */
    public function __construct($name, array $defaultOptions = [])
    {
        $this->name           = $name;
        $this->defaultOptions = $defaultOptions;
    }

    /**
     * @param $label
     * @param $options
     *
     * @return MenuItem
     */
    public function addChild($label, $options)
    {
        $menu = new MenuItem($label, $this->defaultOptions);

        $resolver = new OptionsResolver();
        $this->setDefaultOptions($resolver);
        $options = $resolver->resolve($options);

        $menu
            ->setPath($options['path'])
            ->setUri($options['uri']);

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
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->defaultOptions += [
            'path' => null,
            'uri'  => null,
        ];

        $resolver->setDefaults($this->defaultOptions);
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
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     *
     * @return $this
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }

    #####################
    #### INTERFACING ####
    #####################

    /**
     * Implements IteratorAggregate
     *
     * @return \ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }

    /**
     * Implements Countable
     *
     * @return int
     */
    public function count()
    {
        return count($this->children);
    }
}