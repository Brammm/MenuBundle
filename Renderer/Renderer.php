<?php

namespace Brammm\MenuBundle\Renderer;

use Brammm\MenuBundle\Provider\MenuProvider;

class Renderer implements RendererInterface
{

    /** @var \Twig_Environment */
    private $environment;
    /** @var MenuProvider */
    private $provider;
    /** @var \Twig_Template */
    private $theme;

    public function __construct(\Twig_Environment $environment, MenuProvider $provider, $theme)
    {
        // Use setter because probably string
        $this->environment = $environment;
        $this->provider    = $provider;

        $this->setTheme($theme);
    }

    public function renderMenu($menuName)
    {
        $menu = $this->provider->getMenu($menuName);

        var_dump($menu); exit;

        return $this->renderBlock('menu');
    }

    public function renderBlock($block, array $data = [])
    {
        return $this->theme->renderBlock($block, $data);
    }

    /**
     * @param \Twig_Template|string $theme
     */
    public function setTheme($theme)
    {
        if ($theme instanceof \Twig_Template) {
            $this->theme = $theme;
            return $this;
        }

        if (is_string($theme)) {
            $this->theme = $this->environment->loadTemplate($theme);
            return $this;
        }

        throw new \InvalidArgumentException(sprintf(
                '$theme must be string or instance of Twig_Template, is %s.',
                gettype($theme)
            ));
    }
} 