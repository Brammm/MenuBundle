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
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('brammm_menu', [$this->renderer, 'renderMenu'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('menu_item', [$this->renderer, 'renderItem'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('menu_link', [$this->renderer, 'renderLink'], ['is_safe' => ['html']]),
        ];
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
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'brammm_menu';
    }
}