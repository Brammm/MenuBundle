<?php

namespace Brammm\MenuBundle\Renderer;

class Renderer implements RendererInterface
{

    /** @var \Twig_Template */
    private $theme;
    /** @var \Twig_Environment */
    private $environment;

    public function __construct(\Twig_Environment $environment, $theme)
    {
        $this->environment  = $environment;
        $this->setTheme($theme); // Use setter because probably string
    }

    public function renderMenu()
    {
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