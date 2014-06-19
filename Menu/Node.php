<?php

namespace Brammm\MenuBundle\Menu;

class Node
{
    /** @var string */
    private $label;
    /** @var string */
    private $path;
    /** @var string */
    private $uri;
    /** @var int */
    private $level;
    /** @var Node[]|null */
    private $children;
    /** @var Node|null */
    private $parent;

    /**
     * @return Node[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param Node[] $children
     *
     * @return $this
     */
    public function setChildren(array $children)
    {
        $this->children = null;
        foreach ($children as $child) {
            $this->addChild($child);
        }
        return $this;
    }

    /**
     * @param Node $child
     *
     * @return $this
     */
    public function addChild(Node $child)
    {
        $this->children[] = $child;
        return $child;
    }

    /**
     * @param Node $child
     *
     * @return $this
     */
    public function removeChild(Node $child)
    {
        if (null === $this->children) {
            return $this;
        }

        foreach ($this->children as $key => $chChild) {
            if ($chChild === $child) {
                unset($this->children[$key]);
                $this->children = array_values($this->children); // reset keys
                return $this;
            }
        }
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
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
     * @return Node
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param Node $parent
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

    /**
     * Convenience method to return parent
     *
     * @return Node|null
     */
    public function end()
    {
        return $this->getParent();
    }

} 