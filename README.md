Brammm\MenuBundle
===================

[![Build Status](https://travis-ci.org/Brammm/MenuBundle.svg?branch=master)](https://travis-ci.org/Brammm/MenuBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Brammm/MenuBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Brammm/MenuBundle/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Brammm/MenuBundle/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Brammm/MenuBundle/?branch=master)

**Note: This is really early stuff and not finished yet**

A menu bundle that's very themeable.

## Install

Via Composer (the bundle isn't added to Packagist just yet, so you have to add the repository manually):

```json
{
    "repositories": [
        {
            "url": "https://github.com/Brammm/MenuBundle.git",
            "type": "git"
        }
    ],
    "require": {
        "brammm/menu-bundle": "dev-master"
    }
}
```

## Usage

Create a class that extends the `Brammm\MenuBundle\Menu\AbstractBuilder`. Implement the `buildMenu` method. 

Create a menu and return it like so:

```php 
public function buildMenu()
{
    $menu = new MenuItem('nav', $this);

    $menu
        ->addChild('Home', [
            'path' => 'home',
        ])->end()
        ->addChild('Manage', [
            'uri' => '#'
        ])
            ->addChild('Blog', [
                'path' => 'blog',
            ])->end()
            ->addChild('Comments', [
                'path' => 'comments',
            ])->end()
        ->end();

    return $menu;
}
```

Define the Builder as a service and tag it.

```xml
<service id="acme_demo.menu.nav" class="Acme\DemoBundle\Menu\NavBuilder">
    <tag name="brammm_menu.menu"/>
</service>
```

Render the nav using 

```
{{ brammm_menu_render('nav') }}
```

**Note:** `nav` is the name you gave the menu when creating it in the builder.


## Contributing

Go right ahead, submit a PR. I'm open to suggestions.

## License

The MIT License (MIT). Please see [License File](https://github.com/Brammm/MenuBundle/blob/master/Resources/meta/LICENSE) for more information.
