<?php

namespace wpcmart;

$theme = wp_get_theme();
define( __NAMESPACE__ . '\THEME_SLUG', get_option( 'template' ) );
define( __NAMESPACE__ . '\THEME_NAME', $theme->get( 'Name' ) );
define( __NAMESPACE__ . '\THEME_VERSION', $theme->get( 'Version' ) );
define( __NAMESPACE__ . '\THEME_TEXTDOMAIN', $theme->get( 'TextDomain' ) );
define( __NAMESPACE__ . '\THEME_DESCRIPTION', $theme->get( 'Description' ) );
define( __NAMESPACE__ . '\THEME_AUTHOR', $theme->get( 'Author' ) );
define( __NAMESPACE__ . '\THEME_AUTHOR_URI', $theme->get( 'AuthorURI' ) );
