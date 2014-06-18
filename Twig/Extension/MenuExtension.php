<?php

namespace Brammm\MenuBundle\Twig\Extension;

use Brammm\MenuBundle\Menu\MenuRendererInterface;
use Brammm\MenuBundle\Twig\TokenParser\MenuThemeTokenParser;

class MenuExtension extends \Twig_Extension
{

    /** @var MenuRendererInterface */
    public $renderer;

    public function __construct(MenuRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritdoc}
     */
    public function getTokenParsers()
    {
        return array(
            new MenuThemeTokenParser(),
        );
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