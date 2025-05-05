<?php

// Constants
define('THEME_BASE', get_template_directory_uri());
define('THEME_PATH', get_template_directory());

// Include Composer autoload
include_once THEME_PATH . '/../../../../vendor/autoload.php';

use SkeletonTheme\Security;
use SkeletonTheme\Styles;
use SkeletonTheme\Scripts;

Security::init();
Styles::init();
Scripts::init();
