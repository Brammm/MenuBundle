<?php

namespace Brammm\MenuBundle\Menu\Provider;

use Brammm\MenuBundle\Menu\Builder\BuilderInterface;
use Brammm\MenuBundle\Menu\Menu;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Stores and provides menus
 *
 * @author Bram Van der Sype <bram.vandersype@gmail.com>
 */
class MenuProvider
{
    /** @var array */
    private $menus;

    /**
     * @param BuilderInterface $builder
     *
     * @return $this
     */
    public function addMenu(BuilderInterface $builder)
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'path' => null,
            'uri'  => null,
        ]);
        $builder->setDefaultOptions($resolver);

        $menu = new Menu($builder->getName(), $resolver);

        $builder->buildMenu($menu);

        $this->menus[$menu->getName()] = $menu;

        return $this;
    }

    /**
     * @param string $name
     */
    public function getMenu($name)
    {
        return $this->menus[$name];
    }
}
