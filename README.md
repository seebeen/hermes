# Hermes

Theme module which contains a collection of sub-modules to add or apply frontend and backend modifications.

Hermes is based on [roots/hermes](https://github.com/roots/hermes), and basically provides a drop-in replacement for it.

## Installation

You can install this module via the command-line

### Composer

From the command line:

```sh
composer require sgi/hermes
```

In your `composer.json`

```json
{
    "require": {
        "sgi/hermes": "1.0"
    }
}
```

## Usage

In your ```functions.php``` file, or in other theme file add:

```php
require 'vendor/autoload.php';

new SGI\WP\Hermes();
```

Alternatively:

```php
use SGI\WP\Hermes as Hermes;

new Hermes();
```

You need to add theme support for hermes sub-modules in your theme.

## Sub-Modules

* **Cleaner WordPress markup**  
  `add_theme_support('hermes-cleanup');`

* **Disable trackbacks**  
  `add_theme_support('hermes-disable-trackbacks');`

* **Disable asset versioning**  
  `add_theme_support('hermes-disable-asset-versioning');`

* **Move all JS to the footer**  
  `add_theme_support('hermes-js-to-footer');`

* **Root relative URLs**  
  `add_theme_support('hermes-relative-urls');`

* **Use ImageMagick as a default Image Editor**  
  `add_theme_support('hermes-use-imagick');`

And in a format you can paste to your theme:
```php
/**
 * Enable Hermes Submodules
 * @link https://github.com/seebeen/hermes
 */

add_theme_support('hermes-cleanup');
add_theme_support('hermes-disable-trackbacks');
add_theme_support('hermes-disable-asset-versioning');
add_theme_support('hermes-js-to-footer');
add_theme_support('hermes-relative-urls');
add_theme_support('hermes-use-imagick');

new SGI\WP\Hermes();
```