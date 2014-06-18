<?php

namespace Brammm\MenuBundle\Twig;

use Brammm\MenuBundle\Menu\MenuRendererInterface;

class MenuExtension extends \Twig_Extension
{

    /** @var MenuRendererInterface */
    private $renderer;

    public function __construct(MenuRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('brammm_menu', [$this->renderer, 'render']),
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'brammm_menu';
    }
}