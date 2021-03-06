<?php

namespace Brammm\MenuBundle\Twig\Extension;

use Brammm\MenuBundle\Renderer\RendererInterface;
use Brammm\MenuBundle\Twig\TokenParser\MenuThemeTokenParser;

/**
 * Twig extension
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class MenuExtension extends \Twig_Extension
{

    /** @var RendererInterface */
    public $renderer;

    /**
     * @param RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('brammm_menu', [$this->renderer, 'renderMenu'], ['is_safe' => ['html']]),
            new \Twig_SimpleFunction('menu_item', [$this->renderer, 'renderItem'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @return \Twig_TokenParser[]
     */
    public function getTokenParsers()
    {
        return [
            new MenuThemeTokenParser(),
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
