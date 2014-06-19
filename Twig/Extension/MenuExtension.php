<?php

namespace Brammm\MenuBundle\Twig\Extension;

use Brammm\MenuBundle\Renderer\RendererInterface;
use Brammm\MenuBundle\Twig\TokenParser\MenuThemeTokenParser;

class MenuExtension extends \Twig_Extension
{

    /** @var RendererInterface */
    public $renderer;

    public function __construct(RendererInterface $renderer)
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
            new \Twig_SimpleFunction('brammm_menu_render', [$this->renderer, 'renderMenu']),
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