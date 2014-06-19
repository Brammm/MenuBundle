<?php

namespace Brammm\MenuBundle\Menu;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

interface BuilderInterface
{
    /**
     * Create a new Menu and return it
     *
     * @return Menu
     */
    public function buildMenu();

    /**
     * Sets the default options for the menu.
     *
     * @param OptionsResolverInterface $resolver The resolver for the options.
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);

} 