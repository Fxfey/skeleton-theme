# 🦴 Skeleton Theme

A lightweight, customizable WordPress theme foundation designed to streamline development workflows. This bespoke theme provides a solid architecture with essential features while maintaining flexibility for custom implementations.

## Setup

### 📥 Installation

Clone this repository into your WordPress themes directory:

```
cd wp-content/themes/
git clone https://github.com/Fxfey/skeleton-theme.git
```

Activate the theme in WordPress admin panel

### 📦 Composer Autoloading

Composer is configured to keep dependencies outside the public root for enhanced security.

1. Navigate above your public root (app/) and initialize Composer:
   `composer init`

2. When prompted for a package name, use:
   `skeleton-theme/app`

3. Replace the autoload section in your `composer.json`:

    ```
    "autoload": {
        "psr-4": {
            "SkeletonTheme\\": "public/wp-content/themes/skeleton-theme/core"
        }
    },
    ```

4. Run the autoload generator:
   `composer dump-autoload`

5. ✅ Voila! autoload should now work!

## Structure

The structure for this theme has been created out of the knowledge i've learn on my developer journey, the heavy lifting in this theme is done via classes within the `core/` directory.

## Features

### 🎨 Styling

Skeleton Theme ships with clean, minimal, and developer-friendly styles out of the box. You can tweak them easily for custom designs.

#### `global.css`

-   Sets up base color variables
-   Using [Josh W Comeau’s CSS Reset](https://www.joshwcomeau.com/css/custom-css-reset/)

#### `typography.css`

-   Defines scalable font sizes for all heading tags (`<h1>–<h6>`)

#### `404.css`

-   Basic styling for the 404 error page

### 🧠 Scripts

-   Built with jQuery for fast development and easy DOM manipulation

### 🔐 Security

Security is a known issue with wordpress which is why this theme comes with security measures built in.

#### `disableXMLRPC()`

-   Disables XML-RPC as a fallback if server-level rules aren’t applied (`.htaccess` or `nginx`)

#### `removeVersionNumber()`

-   Removes the WordPress version from <head> to obscure WP version from attackers

#### `limitLoginAttempts()`

Protects against brute-force attacks:

1. Configurable Limits:

    - `MAX_LOGIN_ATTEMPTS`: Default 5
    - `LOCKOUT_DURATION`: Default 15 minutes

2. How It Works:

    - Tracks failed attempts per IP using transients
    - Shows custom error message during lockout
    - Resets counter after successful login

### 👥 Roles

The `Roles` class reduces dashboard clutter by customizing the Editor role:

-   Removes Comments & Tools for Editors
    (Clients should focus solely on content)

### 🪐 Headless

#### Features

-   ✅ Toggleable headless API from the WP admin
-   📚 Dynamic REST API endpoints for all public post types
-   🧱 Parses Gutenberg blocks into structured JSON
-   📄 Supports pagination
-   🖼 Image block parsing with multiple sizes
-   🧾 List and heading block extraction

#### Upcoming Features

-   🗂 Taxonomy & Meta Data Integration
    Include categories, tags, and custom fields in API response.
-   ✨ Rich Text Block (core/paragraph)
    Proper handling for paragraph content with inline formatting (bold, links, etc.).
-   🧲 Embed Blocks (core/embed, YouTube, Vimeo, etc.)
    Detect and extract embed URLs and their providers (great for video/audio previews).
-   🗨 Quote Blocks (core/quote)
    Parse quote content and citation separately.

#### 📌 Notes

Ensure Gutenberg is enabled and used for content blocks to parse correctly.
Image parsing assumes default WordPress structure for wp_get_attachment_metadata.
