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

## Structure

The structure for this theme has been created out of the knowledge i've learn on my developer journey, the heavy lifting in this theme is done via classes within the `core/` directory.

### `Styles`

This class is what handles the CSS sheets for the theme, it currently does the following:

-   Enqueues the global stylesheet

## Features

### Styling

The Skeleton Theme comes out the box with some pre defined styles which speed up the development process straight away, if these need to be tweaked - they're made in a way which lets be happen easily and efficiently.

#### `global.css`

Contains the color theme and a modern CSS reset,
Thanks to [Josh W Comeau](https://www.joshwcomeau.com/css/custom-css-reset/) for this one!

#### `typography.css`

Contains the setup of the theme typography, pre defining the absolute sizings for `<h*>` tags

#### `404.css`

Contains the 404 page styling.

### Scripts

The scripts for this site use jQuery, mainly due to the fact that we are planning for efficiency here. jQuery provides us with this.

### Security

Security is a known issue with wordpress which is why this theme comes with security measures built in.

#### `disableXMLRPC()`

This is a fallback function just in case when setting up this theme, changing the rules in `htaccess` or `nginx` is nto performed.

#### `removeVersionNumber()`

Removes the WordPress version number from the site's <head> section by unhooking the wp_generator action.

#### `limitLoginAttempts()`

Limits login attempts to protect against brute-force attacks by locking the user out temporarily after a set number of failed login attempts. The method works as follows:

1. Configuration:

    `MAX_LOGIN_ATTEMPTS`: Maximum allowed login attempts (default: 5).<br>
    `LOCKOUT_DURATION`: Duration of the lockout period (default: 15 minutes).

2. On Failed Login:

    Every failed login attempt is tracked using a transient (temporary key) based on the user's IP address. The number of failed attempts increases with each failure.

3. Login Error Message:

    If too many failed attempts have been made, a custom error message is returned instead of the usual login error, informing the user to try again after the lockout period.

4. Authentication Check:

    If too many failed login attempts are detected, further login attempts are blocked, and an error message is returned.

5. Reset on Successful Login:

    If the user logs in successfully, the failed login attempt counter for their IP address is reset.

### Roles

The Roles class pure purpose is to remove some bloat which is not required when developing simple sites.
In this case we remove `comments` & `tools` from the Editor role - this is because as a client their only worry should be the content.
