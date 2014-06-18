<?php

namespace Brammm\MenuBundle\Twig\TokenParser;

use Brammm\MenuBundle\Twig\Node\MenuThemeNode;

class MenuThemeTokenParser extends \Twig_TokenParser
{

    /**
     * Parses a token and returns a node.
     *
     * @param \Twig_Token $token A Twig_Token instance
     *
     * @return \Twig_NodeInterface A Twig_NodeInterface instance
     *
     * @throws \Twig_Error_Syntax
     */
    public function parse(\Twig_Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();

        $template = $this->parser->getExpressionParser()->parseExpression();

        $stream->expect(\Twig_Token::BLOCK_END_TYPE);

        return new MenuThemeNode($template, $lineno, $this->getTag());
    }

    /**
     * Gets the tag name associated with this token parser.
     *
     * @return string The tag name
     */
    public function getTag()
    {
        return 'menu_theme';
    }
}