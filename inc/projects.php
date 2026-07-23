<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
==========================================
TM Pizza Project System
==========================================
*/


/*
Register project post type and division taxonomy
*/

function tmpizza_register_projects() {

    /*
    Project divisions
    */

    $division_labels = array(
        'name'              => 'Részlegek',
        'singular_name'     => 'Részleg',
        'search_items'      => 'Részlegek keresése',
        'all_items'         => 'Összes részleg',
        'parent_item'       => 'Szülő részleg',
        'parent_item_colon' => 'Szülő részleg:',
        'edit_item'         => 'Részleg szerkesztése',
        'update_item'       => 'Részleg frissítése',
        'add_new_item'      => 'Új részleg hozzáadása',
        'new_item_name'     => 'Új részleg neve',
        'menu_name'         => 'Részlegek',
    );

    register_taxonomy(
        'tmpizza_division',
        array('tmpizza_project'),
        array(
            'labels'            => $division_labels,
            'public'            => true,
            'hierarchical'      => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,

            'rewrite' => array(
                'slug'       => 'reszleg',
                'with_front' => false,
            ),
        )
    );


    /*
    Projects
    */

    $project_labels = array(
        'name'                  => 'Projektek',
        'singular_name'         => 'Projekt',
        'menu_name'             => 'Projektek',
        'name_admin_bar'        => 'Projekt',
        'add_new'               => 'Új projekt',
        'add_new_item'          => 'Új projekt hozzáadása',
        'new_item'              => 'Új projekt',
        'edit_item'             => 'Projekt szerkesztése',
        'view_item'             => 'Projekt megtekintése',
        'all_items'             => 'Összes projekt',
        'search_items'          => 'Projektek keresése',
        'parent_item_colon'     => 'Szülőprojekt:',
        'not_found'             => 'Nem található projekt.',
        'not_found_in_trash'    => 'A lomtárban nincs projekt.',
        'featured_image'        => 'Projekt borítóképe',
        'set_featured_image'    => 'Borítókép beállítása',
        'remove_featured_image' => 'Borítókép eltávolítása',
        'use_featured_image'    => 'Használat borítóképként',
        'archives'              => 'Projektarchívum',
        'attributes'            => 'Projekt tulajdonságai',
    );

    register_post_type(
        'tmpizza_project',
        array(
            'labels' => $project_labels,

            'description' =>
                'A TM Pizza játék-, film- és workshopprojektjei.',

            'public'             => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'show_in_admin_bar'  => true,
            'show_in_nav_menus'  => true,
            'show_in_rest'       => true,
            'publicly_queryable' => true,
            'exclude_from_search'=> false,

            'menu_position' => 5,
            'menu_icon'     => 'dashicons-hammer',

            'has_archive' => true,
            'hierarchical'=> false,

            'rewrite' => array(
                'slug'       => 'projektek',
                'with_front' => false,
            ),

            'query_var' => true,

            'supports' => array(
                'title',
                'editor',
                'excerpt',
                'thumbnail',
                'revisions',
            ),

            'taxonomies' => array(
                'tmpizza_division',
            ),
        )
    );

    register_taxonomy_for_object_type(
        'tmpizza_division',
        'tmpizza_project'
    );
}

add_action('init', 'tmpizza_register_projects');


/*
Available project statuses
*/

function tmpizza_project_statuses() {

    return array(
        'concept'     => 'Ötlet / koncepció',
        'development' => 'Fejlesztés alatt',
        'testing'     => 'Tesztelés alatt',
        'released'    => 'Megjelent',
        'paused'      => 'Szüneteltetve',
        'cancelled'   => 'Leállítva',
    );
}


/*
Register the project information meta box
*/

function tmpizza_add_project_meta_boxes() {

    add_meta_box(
        'tmpizza-project-details',
        'Projektinformációk',
        'tmpizza_render_project_meta_box',
        'tmpizza_project',
        'normal',
        'high'
    );
}

add_action(
    'add_meta_boxes_tmpizza_project',
    'tmpizza_add_project_meta_boxes'
);


/*
Display the project information fields
*/

function tmpizza_render_project_meta_box($post) {

    wp_nonce_field(
        'tmpizza_save_project_details',
        'tmpizza_project_nonce'
    );

    $status = get_post_meta(
        $post->ID,
        '_tmpizza_project_status',
        true
    );

    $platform = get_post_meta(
        $post->ID,
        '_tmpizza_project_platform',
        true
    );

    $project_url = get_post_meta(
        $post->ID,
        '_tmpizza_project_url',
        true
    );

    $featured = get_post_meta(
        $post->ID,
        '_tmpizza_project_featured',
        true
    );

    $project_order = get_post_meta(
        $post->ID,
        '_tmpizza_project_order',
        true
    );

    if (empty($status)) {
        $status = 'development';
    }

    if ($project_order === '') {
        $project_order = 0;
    }

    $statuses = tmpizza_project_statuses();

    ?>

    <style>
        .tmpizza-project-fields {
            display: grid;
            gap: 22px;
            padding: 8px 0;
        }

        .tmpizza-project-field {
            display: grid;
            gap: 8px;
        }

        .tmpizza-project-field label {
            font-weight: 600;
        }

        .tmpizza-project-field input[type="text"],
        .tmpizza-project-field input[type="url"],
        .tmpizza-project-field input[type="number"],
        .tmpizza-project-field select {
            width: 100%;
            max-width: 620px;
        }

        .tmpizza-project-field small {
            max-width: 620px;
            color: #646970;
        }

        .tmpizza-project-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>

    <div class="tmpizza-project-fields">

        <div class="tmpizza-project-field">

            <label for="tmpizza-project-status">
                Fejlesztési állapot
            </label>

            <select
                id="tmpizza-project-status"
                name="tmpizza_project_status"
            >

                <?php foreach ($statuses as $value => $label) : ?>

                    <option
                        value="<?php echo esc_attr($value); ?>"
                        <?php selected($status, $value); ?>
                    >
                        <?php echo esc_html($label); ?>
                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="tmpizza-project-field">

            <label for="tmpizza-project-platform">
                Platform vagy technológia
            </label>

            <input
                id="tmpizza-project-platform"
                type="text"
                name="tmpizza_project_platform"
                value="<?php echo esc_attr($platform); ?>"
                placeholder="Például: Roblox, YouTube, Android"
            >

            <small>
                Több értéket vesszővel választhatsz el.
            </small>

        </div>

        <div class="tmpizza-project-field">

            <label for="tmpizza-project-url">
                Külső projektlink
            </label>

            <input
                id="tmpizza-project-url"
                type="url"
                name="tmpizza_project_url"
                value="<?php echo esc_attr($project_url); ?>"
                placeholder="https://..."
            >

            <small>
                Például Roblox-, YouTube-, GitHub- vagy letöltési link.
                Üresen is hagyható.
            </small>

        </div>

        <div class="tmpizza-project-field">

            <label for="tmpizza-project-order">
                Megjelenítési sorrend
            </label>

            <input
                id="tmpizza-project-order"
                type="number"
                name="tmpizza_project_order"
                value="<?php echo esc_attr($project_order); ?>"
                min="0"
                step="1"
            >

            <small>
                Az alacsonyabb számú projektek jelennek meg előbb.
            </small>

        </div>

        <div class="tmpizza-project-field">

            <label class="tmpizza-project-checkbox">

                <input
                    type="checkbox"
                    name="tmpizza_project_featured"
                    value="1"
                    <?php checked($featured, '1'); ?>
                >

                Kiemelt projekt

            </label>

            <small>
                A kezdőlap nagy projektkártyájához ezt fogjuk használni.
            </small>

        </div>

    </div>

    <?php
}


/*
Save project information
*/

function tmpizza_save_project_details($post_id) {

    if (
        !isset($_POST['tmpizza_project_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(
                wp_unslash($_POST['tmpizza_project_nonce'])
            ),
            'tmpizza_save_project_details'
        )
    ) {
        return;
    }

    if (
        defined('DOING_AUTOSAVE') &&
        DOING_AUTOSAVE
    ) {
        return;
    }

    if (wp_is_post_revision($post_id)) {
        return;
    }

    if (
        !current_user_can(
            'edit_post',
            $post_id
        )
    ) {
        return;
    }

    if (
        get_post_type($post_id) !==
        'tmpizza_project'
    ) {
        return;
    }


    /*
    Status
    */

    $statuses = tmpizza_project_statuses();

    $status = isset($_POST['tmpizza_project_status'])
        ? sanitize_key(
            wp_unslash($_POST['tmpizza_project_status'])
        )
        : '';

    if (array_key_exists($status, $statuses)) {
        update_post_meta(
            $post_id,
            '_tmpizza_project_status',
            $status
        );
    } else {
        delete_post_meta(
            $post_id,
            '_tmpizza_project_status'
        );
    }


    /*
    Platform
    */

    $platform = isset($_POST['tmpizza_project_platform'])
        ? sanitize_text_field(
            wp_unslash($_POST['tmpizza_project_platform'])
        )
        : '';

    if ($platform !== '') {
        update_post_meta(
            $post_id,
            '_tmpizza_project_platform',
            $platform
        );
    } else {
        delete_post_meta(
            $post_id,
            '_tmpizza_project_platform'
        );
    }


    /*
    External URL
    */

    $project_url = isset($_POST['tmpizza_project_url'])
        ? esc_url_raw(
            wp_unslash($_POST['tmpizza_project_url'])
        )
        : '';

    if ($project_url !== '') {
        update_post_meta(
            $post_id,
            '_tmpizza_project_url',
            $project_url
        );
    } else {
        delete_post_meta(
            $post_id,
            '_tmpizza_project_url'
        );
    }


    /*
    Display order
    */

    $project_order = isset($_POST['tmpizza_project_order'])
        ? absint($_POST['tmpizza_project_order'])
        : 0;

    update_post_meta(
        $post_id,
        '_tmpizza_project_order',
        $project_order
    );


    /*
    Featured state
    */

    $featured = isset($_POST['tmpizza_project_featured'])
        ? '1'
        : '0';

    update_post_meta(
        $post_id,
        '_tmpizza_project_featured',
        $featured
    );
}

add_action(
    'save_post_tmpizza_project',
    'tmpizza_save_project_details'
);


/*
Add useful columns to the project list
*/

function tmpizza_project_admin_columns($columns) {

    $new_columns = array();

    foreach ($columns as $key => $label) {

        if ($key === 'title') {
            $new_columns['tmpizza_thumbnail'] = 'Borító';
        }

        $new_columns[$key] = $label;

        if ($key === 'title') {
            $new_columns['tmpizza_status']   = 'Állapot';
            $new_columns['tmpizza_platform'] = 'Platform';
            $new_columns['tmpizza_featured'] = 'Kiemelt';
        }
    }

    return $new_columns;
}

add_filter(
    'manage_tmpizza_project_posts_columns',
    'tmpizza_project_admin_columns'
);


/*
Display project column values
*/

function tmpizza_project_admin_column_content(
    $column,
    $post_id
) {

    if ($column === 'tmpizza_thumbnail') {

        if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail(
                $post_id,
                array(60, 60),
                array(
                    'style' =>
                        'width:60px;height:60px;object-fit:cover;border-radius:8px;',
                )
            );
        } else {
            echo '<span aria-hidden="true">—</span>';
        }
    }

    if ($column === 'tmpizza_status') {

        $status = get_post_meta(
            $post_id,
            '_tmpizza_project_status',
            true
        );

        $statuses = tmpizza_project_statuses();

        echo isset($statuses[$status])
            ? esc_html($statuses[$status])
            : '—';
    }

    if ($column === 'tmpizza_platform') {

        $platform = get_post_meta(
            $post_id,
            '_tmpizza_project_platform',
            true
        );

        echo $platform
            ? esc_html($platform)
            : '—';
    }

    if ($column === 'tmpizza_featured') {

        $featured = get_post_meta(
            $post_id,
            '_tmpizza_project_featured',
            true
        );

        echo $featured === '1'
            ? '⭐ Igen'
            : 'Nem';
    }
}

add_action(
    'manage_tmpizza_project_posts_custom_column',
    'tmpizza_project_admin_column_content',
    10,
    2
);