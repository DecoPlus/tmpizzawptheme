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
Load theme modules
*/

require_once get_template_directory() . '/inc/projects.php';


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
Asset version based on file modification time
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

    wp_enqueue_style(
        'tmpizza-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    $styles = array(
        'base',
        'header',
        'hero',
        'buttons',
        'divisions',
        'projects',
        'about',
        'join',
        'footer',
    );

    $dependency = 'tmpizza-fonts';

    foreach ($styles as $style) {

        $relative_path =
            '/assets/css/' . $style . '.css';

        wp_enqueue_style(
            'tmpizza-' . $style,
            $theme_uri . $relative_path,
            array($dependency),
            tmpizza_asset_version($relative_path)
        );

        $dependency = 'tmpizza-' . $style;
    }


    /*
    Project archive stylesheet
    */

    if (is_post_type_archive('tmpizza_project')) {

        wp_enqueue_style(
            'tmpizza-project-archive',
            $theme_uri
                . '/assets/css/project-archive.css',
            array($dependency),
            tmpizza_asset_version(
                '/assets/css/project-archive.css'
            )
        );

        $dependency = 'tmpizza-project-archive';
    }


    /*
    Single project stylesheet
    */

    if (is_singular('tmpizza_project')) {

        wp_enqueue_style(
            'tmpizza-single-project',
            $theme_uri
                . '/assets/css/single-project.css',
            array($dependency),
            tmpizza_asset_version(
                '/assets/css/single-project.css'
            )
        );

        $dependency = 'tmpizza-single-project';
    }


    /*
    Animations and responsive overrides
    */

    wp_enqueue_style(
        'tmpizza-animations',
        $theme_uri . '/assets/css/animations.css',
        array($dependency),
        tmpizza_asset_version(
            '/assets/css/animations.css'
        )
    );

    wp_enqueue_style(
        'tmpizza-responsive',
        $theme_uri . '/assets/css/responsive.css',
        array('tmpizza-animations'),
        tmpizza_asset_version(
            '/assets/css/responsive.css'
        )
    );


    /*
    JavaScript
    */

    wp_enqueue_script(
        'tmpizza-main-js',
        $theme_uri . '/assets/js/main.js',
        array(),
        tmpizza_asset_version(
            '/assets/js/main.js'
        ),
        true
    );
}

add_action('wp_enqueue_scripts', 'tmpizza_assets');