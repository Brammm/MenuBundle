<?php

namespace Brammm\MenuBundle\Menu\Builder;

use Brammm\MenuBundle\Menu\Menu;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Interface for a MenuBuilder class
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
interface BuilderInterface
{

    /**
     * Build a menu
     *
     * @param Menu $menu
     */
    public function buildMenu(Menu $menu);

    /**
     * The name of the menu
     *
     * @return string
     */
    public function getName();

    /**
     * Set additional options or override existing default options
     * that will be passed to the Items.
     *
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver);
}
