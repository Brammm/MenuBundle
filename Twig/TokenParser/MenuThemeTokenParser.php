<?php

namespace Brammm\MenuBundle\Twig\TokenParser;

use Brammm\MenuBundle\Twig\Node\MenuThemeNode;

/**
 * Parses the {% menu_theme menu 'theme.html.twig' %} tag
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class MenuThemeTokenParser extends \Twig_TokenParser
{

    /**
     * {@inheritDoc}
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $menuItem = $this->parser->getExpressionParser()->parseExpression();
        $template = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new MenuThemeNode($menuItem, $template, $lineno, $this->getTag());
    }

    /**
     * {@inheritDoc}
     */
    public function getTag()
    {
        return 'menu_theme';
    }
}
