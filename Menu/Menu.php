<?php

namespace Brammm\MenuBundle\Menu;

class Menu 
{
    /** @var Node[] */
    private $nodes;
    /** @var string */
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Node[]
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @param Node[] $nodes
     *
     * @return $this
     */
    public function setNodes($nodes)
    {
        $this->nodes = $nodes;
        return $this;
    }

    /**
     * @param Node $node
     *
     * @return $this
     */
    public function addNode(Node $node)
    {
        $this->nodes[] = $node;
        return $node;
    }

    /**
     * @param Node $node
     *
     * @return $this
     */
    public function removeNode(Node $node)
    {
        if (null === $this->nodes) {
            return $this;
        }

        foreach ($this->nodes as $key => $chChild) {
            if ($chChild === $node) {
                unset($this->nodes[$key]);
                $this->nodes = array_values($this->nodes); // reset keys
                return $this;
            }
        }
        return $this;
    }


} 