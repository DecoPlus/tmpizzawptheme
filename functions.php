<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
==========================================
TM Pizza Theme
==========================================
*/


/*
Theme setup
*/

function tmpizza_setup() {

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    register_nav_menus(
        array(
            'primary' => __('Primary Menu', 'tmpizza'),
        )
    );
}

add_action('after_setup_theme', 'tmpizza_setup');


/*
Return an asset's modification time.
*/

function tmpizza_asset_version($relative_path) {

    $absolute_path =
        get_template_directory() . $relative_path;

    if (file_exists($absolute_path)) {
        return filemtime($absolute_path);
    }

    return wp_get_theme()->get('Version');
}


/*
Load theme assets
*/

function tmpizza_assets() {

    $theme_uri = get_template_directory_uri();


    /*
    Google Fonts
    */

    wp_enqueue_style(
        'tmpizza-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        array(),
        null
    );


    wp_enqueue_style(
        'tmpizza-base',
        $theme_uri . '/assets/css/base.css',
        array('tmpizza-fonts'),
        tmpizza_asset_version('/assets/css/base.css')
    );


    wp_enqueue_style(
        'tmpizza-header',
        $theme_uri . '/assets/css/header.css',
        array('tmpizza-base'),
        tmpizza_asset_version('/assets/css/header.css')
    );


    wp_enqueue_style(
        'tmpizza-hero',
        $theme_uri . '/assets/css/hero.css',
        array('tmpizza-header'),
        tmpizza_asset_version('/assets/css/hero.css')
    );


    wp_enqueue_style(
        'tmpizza-buttons',
        $theme_uri . '/assets/css/buttons.css',
        array('tmpizza-hero'),
        tmpizza_asset_version('/assets/css/buttons.css')
    );


    wp_enqueue_style(
        'tmpizza-divisions',
        $theme_uri . '/assets/css/divisions.css',
        array('tmpizza-buttons'),
        tmpizza_asset_version('/assets/css/divisions.css')
    );


    wp_enqueue_style(
        'tmpizza-projects',
        $theme_uri . '/assets/css/projects.css',
        array('tmpizza-divisions'),
        tmpizza_asset_version('/assets/css/projects.css')
    );


    wp_enqueue_style(
        'tmpizza-about',
        $theme_uri . '/assets/css/about.css',
        array('tmpizza-projects'),
        tmpizza_asset_version('/assets/css/about.css')
    );


    wp_enqueue_style(
        'tmpizza-join',
        $theme_uri . '/assets/css/join.css',
        array('tmpizza-about'),
        tmpizza_asset_version('/assets/css/join.css')
    );


    wp_enqueue_style(
        'tmpizza-footer',
        $theme_uri . '/assets/css/footer.css',
        array('tmpizza-join'),
        tmpizza_asset_version('/assets/css/footer.css')
    );


    wp_enqueue_style(
        'tmpizza-animations',
        $theme_uri . '/assets/css/animations.css',
        array('tmpizza-footer'),
        tmpizza_asset_version('/assets/css/animations.css')
    );


    wp_enqueue_style(
        'tmpizza-responsive',
        $theme_uri . '/assets/css/responsive.css',
        array('tmpizza-animations'),
        tmpizza_asset_version('/assets/css/responsive.css')
    );


    wp_enqueue_script(
        'tmpizza-main-js',
        $theme_uri . '/assets/js/main.js',
        array(),
        tmpizza_asset_version('/assets/js/main.js'),
        true
    );
}

add_action('wp_enqueue_scripts', 'tmpizza_assets');