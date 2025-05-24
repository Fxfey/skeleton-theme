<?php

// Constants
define('THEME_BASE', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// Include Composer autoload
include_once THEME_PATH . '/../../../../vendor/autoload.php';

use SkeletonTheme\Headless;
use SkeletonTheme\Security;
use SkeletonTheme\Styles;
use SkeletonTheme\Scripts;
use SkeletonTheme\Roles;

Security::init();
Styles::init();
Scripts::init();
Roles::init();
Headless::init();
