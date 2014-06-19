<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

abstract class AbstractBuilder implements BuilderInterface
{
    /**
     * Sets the default options for the menu.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
    }

} 