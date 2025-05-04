# Skeleton Theme

A lightweight, customizable WordPress theme foundation designed to streamline development workflows. This bespoke theme provides a solid architecture with essential features while maintaining flexibility for custom implementations.

## Setup

### Installation

Clone this repository into your WordPress themes directory:

```
cd wp-content/themes/
git clone https://github.com/Fxfey/skeleton-theme.git
```

Activate the theme in WordPress admin panel

### Composer

The composer setup is done in a way to ensure site security.

1. Navigate above the public root (the app directory) and initialise composer.
   `composer init`

2. When prompted for a package name you must use `skeleton-theme/app` to ensure all auto loads work correctly.

3. Go into `composer.json` and replace the autoload with the following:

    ```
    "autoload": {
        "psr-4": {
            "SkeletonTheme\\": "public/wp-content/themes/skeleton-theme/core"
        }
    },
    ```

4. Run `composer dump-autoload`

5. Voila! autoload should now work!
