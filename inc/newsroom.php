<?php
/**
 * TM Pizza Newsroom
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}


/*
==========================================
Register Newsroom post type
==========================================
*/

function tmpizza_register_newsroom_post_type() {

    $labels = array(
        'name'                  => 'Newsroom',
        'singular_name'         => 'Newsroom frissítés',
        'menu_name'             => 'Newsroom',
        'name_admin_bar'        => 'Newsroom frissítés',
        'add_new'               => 'Új frissítés',
        'add_new_item'          => 'Új newsroom frissítés',
        'new_item'              => 'Új frissítés',
        'edit_item'             => 'Frissítés szerkesztése',
        'view_item'             => 'Frissítés megtekintése',
        'all_items'             => 'Összes frissítés',
        'search_items'          => 'Frissítések keresése',
        'not_found'             => 'Nem található frissítés.',
        'not_found_in_trash'    => 'A lomtárban nincs frissítés.',
        'featured_image'        => 'Frissítés borítóképe',
        'set_featured_image'    => 'Borítókép beállítása',
        'remove_featured_image' => 'Borítókép eltávolítása',
        'archives'              => 'Newsroom archívum',
    );

    register_post_type(
        'tmpizza_news',
        array(
            'labels'             => $labels,
            'description'        => 'TM Pizza hírek és fejlesztési frissítések.',
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_rest'       => true,
            'show_in_nav_menus'  => true,
            'exclude_from_search'=> false,

            'menu_position'      => 6,
            'menu_icon'          => 'dashicons-megaphone',

            'query_var'          => true,
            'has_archive'        => 'newsroom',

            'rewrite'            => array(
                'slug'       => 'newsroom',
                'with_front' => false,
            ),

            'supports'           => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'author',
                'revisions',
            ),
        )
    );
}

add_action(
    'init',
    'tmpizza_register_newsroom_post_type'
);


/*
==========================================
Newsroom stylesheet
==========================================
*/

function tmpizza_newsroom_assets() {

    if (
        !is_post_type_archive('tmpizza_news') &&
        !is_singular('tmpizza_news')
    ) {
        return;
    }

    $relative_path =
        '/assets/css/newsroom.css';

    $absolute_path =
        get_template_directory()
        . $relative_path;

    $version = file_exists($absolute_path)
        ? filemtime($absolute_path)
        : wp_get_theme()->get('Version');

    wp_enqueue_style(
        'tmpizza-newsroom',
        get_template_directory_uri()
            . $relative_path,
        array('tmpizza-responsive'),
        $version
    );
}

add_action(
    'wp_enqueue_scripts',
    'tmpizza_newsroom_assets',
    20
);


/*
==========================================
Newsroom admin columns
==========================================
*/

function tmpizza_newsroom_columns($columns) {

    $new_columns = array();

    foreach ($columns as $key => $label) {

        $new_columns[$key] = $label;

        if ($key === 'title') {
            $new_columns['newsroom_image'] =
                'Borítókép';
        }
    }

    return $new_columns;
}

add_filter(
    'manage_tmpizza_news_posts_columns',
    'tmpizza_newsroom_columns'
);


function tmpizza_newsroom_column_content(
    $column,
    $post_id
) {

    if ($column !== 'newsroom_image') {
        return;
    }

    if (has_post_thumbnail($post_id)) {

        echo get_the_post_thumbnail(
            $post_id,
            array(80, 50),
            array(
                'style' =>
                    'width:80px;height:50px;'
                    . 'object-fit:cover;border-radius:8px;',
            )
        );

        return;
    }

    echo '—';
}

add_action(
    'manage_tmpizza_news_posts_custom_column',
    'tmpizza_newsroom_column_content',
    10,
    2
);