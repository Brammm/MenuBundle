<?php

namespace Brammm\MenuBundle\Tests\Menu\Renderer;

use Brammm\MenuBundle\Menu\Renderer\TwigRenderer;

class TwigRendererTest extends \PHPUnit_Framework_TestCase
{
    /** @var TwigRenderer */
    private $SUT;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $environment;
    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $template;

    public function setUp()
    {
        $this->environment = $this->getMockBuilder('\Twig_Environment')
            ->getMock();

        $this->template = $this->getMockBuilder('Brammm\MenuBundle\Tests\Menu\Renderer\Twig_TemplateTest')
            ->disableOriginalConstructor()
            ->getMock();

        $this->SUT = new TwigRenderer($this->environment, 'foo');
    }

    public function testCanRenderMenu()
    {
        $this->environmentWillLoadTheme('foo');
        $this->templateRendersBlock('menu');

        $this->SUT->renderMenu($this->getItem('item'));
    }

    public function testCanRenderMenuItem()
    {
        $this->environmentWillLoadTheme('foo');
        $this->templateRendersBlock('menu_item');

        $this->SUT->renderItem($this->getItem('item'));
    }

    public function testCanSetTheme()
    {
        $item = $this->getItem('item');

        $this->SUT->setTheme($item, 'bar');

        $this->environmentWillLoadTheme('bar');

        $this->SUT->renderMenu($item);
    }

    public function testCanRenderParentTheme()
    {
        $parent = $this->getItem('parent');
        $child  = $this->getItem('child');
        $child->expects($this->once())
            ->method('getParent')
            ->will($this->returnValue($parent));

        $this->SUT->setTheme($parent, 'baz');

        $this->environmentWillLoadTheme('baz');

        $this->SUT->renderMenu($child);
    }

    private function environmentWillLoadTheme($theme)
    {
        $this->environment->expects($this->once())
            ->method('loadTemplate')
            ->with($theme)
            ->will($this->returnValue($this->template));
    }

    private function templateRendersBlock($block)
    {
        $this->template->expects($this->once())
            ->method('renderBlock')
            ->with($block);
    }

    private function getItem($name)
    {
        $item = $this->getMockBuilder('Brammm\MenuBundle\Menu\Item')
            ->disableOriginalConstructor()
            ->getMock();

        $item->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($name));

        return $item;
    }
}

class Twig_TemplateTest extends \Twig_Template
{
    protected $useExtGetAttribute = false;

    public function __construct(\Twig_Environment $env, $useExtGetAttribute = false)
    {
        parent::__construct($env);
        $this->useExtGetAttribute = $useExtGetAttribute;
        \Twig_Template::clearCache();
    }

    public function getZero()
    {
        return 0;
    }

    public function getEmpty()
    {
        return '';
    }

    public function getString()
    {
        return 'some_string';
    }

    public function getTrue()
    {
        return true;
    }

    public function getTemplateName()
    {
    }

    public function getDebugInfo()
    {
        return array();
    }

    protected function doGetParent(array $context)
    {
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
    }

    public function getAttribute($object, $item, array $arguments = array(), $type = self::ANY_CALL, $isDefinedTest = false, $ignoreStrictCheck = false)
    {
        if ($this->useExtGetAttribute) {
            return twig_template_get_attributes($this, $object, $item, $arguments, $type, $isDefinedTest, $ignoreStrictCheck);
        } else {
            return parent::getAttribute($object, $item, $arguments, $type, $isDefinedTest, $ignoreStrictCheck);
        }
    }
}