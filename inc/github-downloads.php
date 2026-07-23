<?php
/**
 * TM Pizza GitHub project downloads
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}


/*
==========================================
GitHub meta box
==========================================
*/

function tmpizza_add_github_download_meta_box() {

    add_meta_box(
        'tmpizza-github-download',
        'GitHub és letöltés',
        'tmpizza_render_github_download_meta_box',
        'tmpizza_project',
        'normal',
        'default'
    );
}

add_action(
    'add_meta_boxes_tmpizza_project',
    'tmpizza_add_github_download_meta_box'
);


function tmpizza_render_github_download_meta_box(
    $post
) {

    wp_nonce_field(
        'tmpizza_save_github_download',
        'tmpizza_github_download_nonce'
    );

    $repository_url = get_post_meta(
        $post->ID,
        '_tmpizza_github_repository_url',
        true
    );

    $branch = get_post_meta(
        $post->ID,
        '_tmpizza_github_branch',
        true
    );

    $direct_download_url = get_post_meta(
        $post->ID,
        '_tmpizza_github_download_url',
        true
    );

    $button_label = get_post_meta(
        $post->ID,
        '_tmpizza_github_button_label',
        true
    );

    if (empty($branch)) {
        $branch = 'main';
    }

    if (empty($button_label)) {
        $button_label = 'Letöltés GitHubról';
    }

    ?>

    <div class="tmpizza-github-admin">

        <p>
            <label
                for="tmpizza-github-repository-url"
            >
                <strong>GitHub repository URL</strong>
            </label>
        </p>

        <input
            id="tmpizza-github-repository-url"
            name="tmpizza_github_repository_url"
            type="url"
            class="widefat"
            value="<?php
            echo esc_attr($repository_url);
            ?>"
            placeholder="https://github.com/felhasznalo/projekt"
        >

        <p class="description">
            A projekt GitHub repositoryjának címe.
        </p>


        <p style="margin-top:24px;">
            <label for="tmpizza-github-branch">
                <strong>Letölthető branch</strong>
            </label>
        </p>

        <input
            id="tmpizza-github-branch"
            name="tmpizza_github_branch"
            type="text"
            class="regular-text"
            value="<?php
            echo esc_attr($branch);
            ?>"
            placeholder="main"
        >

        <p class="description">
            Ha nincs külön közvetlen letöltési URL,
            ebből a branchből készül ZIP-letöltés.
        </p>


        <p style="margin-top:24px;">
            <label
                for="tmpizza-github-download-url"
            >
                <strong>
                    Közvetlen GitHub-letöltési URL
                </strong>
            </label>
        </p>

        <input
            id="tmpizza-github-download-url"
            name="tmpizza_github_download_url"
            type="url"
            class="widefat"
            value="<?php
            echo esc_attr($direct_download_url);
            ?>"
            placeholder="https://github.com/felhasznalo/projekt/releases/latest/download/projekt.zip"
        >

        <p class="description">
            Opcionális. Ha ki van töltve, ez felülírja
            az automatikus branch-ZIP címet.
        </p>


        <p style="margin-top:24px;">
            <label
                for="tmpizza-github-button-label"
            >
                <strong>Letöltés gomb felirata</strong>
            </label>
        </p>

        <input
            id="tmpizza-github-button-label"
            name="tmpizza_github_button_label"
            type="text"
            class="regular-text"
            value="<?php
            echo esc_attr($button_label);
            ?>"
            placeholder="Letöltés GitHubról"
        >

    </div>

    <?php
}


/*
==========================================
URL validation
==========================================
*/

function tmpizza_sanitize_github_url($url) {

    $url = esc_url_raw(
        trim((string) $url)
    );

    if (empty($url)) {
        return '';
    }

    $host = strtolower(
        (string) wp_parse_url(
            $url,
            PHP_URL_HOST
        )
    );

    $allowed_hosts = array(
        'github.com',
        'www.github.com',
    );

    if (!in_array($host, $allowed_hosts, true)) {
        return '';
    }

    return $url;
}


/*
==========================================
Save GitHub fields
==========================================
*/

function tmpizza_save_github_download_meta(
    $post_id
) {

    if (
        !isset(
            $_POST['tmpizza_github_download_nonce']
        )
    ) {
        return;
    }

    $nonce = sanitize_text_field(
        wp_unslash(
            $_POST['tmpizza_github_download_nonce']
        )
    );

    if (
        !wp_verify_nonce(
            $nonce,
            'tmpizza_save_github_download'
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


    /*
    Repository URL
    */

    $repository_url = isset(
        $_POST['tmpizza_github_repository_url']
    )
        ? tmpizza_sanitize_github_url(
            wp_unslash(
                $_POST[
                    'tmpizza_github_repository_url'
                ]
            )
        )
        : '';

    if ($repository_url) {

        update_post_meta(
            $post_id,
            '_tmpizza_github_repository_url',
            $repository_url
        );

    } else {

        delete_post_meta(
            $post_id,
            '_tmpizza_github_repository_url'
        );
    }


    /*
    Branch
    */

    $branch = isset(
        $_POST['tmpizza_github_branch']
    )
        ? sanitize_text_field(
            wp_unslash(
                $_POST['tmpizza_github_branch']
            )
        )
        : 'main';

    if (
        empty($branch) ||
        !preg_match(
            '/^[A-Za-z0-9._\/-]+$/',
            $branch
        )
    ) {
        $branch = 'main';
    }

    update_post_meta(
        $post_id,
        '_tmpizza_github_branch',
        $branch
    );


    /*
    Direct download URL
    */

    $download_url = isset(
        $_POST['tmpizza_github_download_url']
    )
        ? tmpizza_sanitize_github_url(
            wp_unslash(
                $_POST[
                    'tmpizza_github_download_url'
                ]
            )
        )
        : '';

    if ($download_url) {

        update_post_meta(
            $post_id,
            '_tmpizza_github_download_url',
            $download_url
        );

    } else {

        delete_post_meta(
            $post_id,
            '_tmpizza_github_download_url'
        );
    }


    /*
    Button label
    */

    $button_label = isset(
        $_POST['tmpizza_github_button_label']
    )
        ? sanitize_text_field(
            wp_unslash(
                $_POST[
                    'tmpizza_github_button_label'
                ]
            )
        )
        : '';

    if (empty($button_label)) {
        $button_label =
            'Letöltés GitHubról';
    }

    update_post_meta(
        $post_id,
        '_tmpizza_github_button_label',
        $button_label
    );
}

add_action(
    'save_post_tmpizza_project',
    'tmpizza_save_github_download_meta'
);


/*
==========================================
Build download URL
==========================================
*/

function tmpizza_get_github_download_url(
    $post_id
) {

    $direct_url = get_post_meta(
        $post_id,
        '_tmpizza_github_download_url',
        true
    );

    if (!empty($direct_url)) {
        return $direct_url;
    }


    $repository_url = get_post_meta(
        $post_id,
        '_tmpizza_github_repository_url',
        true
    );

    if (empty($repository_url)) {
        return '';
    }

    $branch = get_post_meta(
        $post_id,
        '_tmpizza_github_branch',
        true
    );

    if (empty($branch)) {
        $branch = 'main';
    }

    $repository_url = untrailingslashit(
        preg_replace(
            '/\.git$/',
            '',
            $repository_url
        )
    );

    $encoded_branch = str_replace(
        '%2F',
        '/',
        rawurlencode($branch)
    );

    return $repository_url
        . '/archive/refs/heads/'
        . $encoded_branch
        . '.zip';
}


/*
==========================================
Append buttons to project content
==========================================
*/

function tmpizza_append_github_project_buttons(
    $content
) {

    if (
        !is_singular('tmpizza_project') ||
        !in_the_loop() ||
        !is_main_query()
    ) {
        return $content;
    }

    $post_id = get_the_ID();

    $repository_url = get_post_meta(
        $post_id,
        '_tmpizza_github_repository_url',
        true
    );

    $download_url =
        tmpizza_get_github_download_url(
            $post_id
        );

    if (
        empty($repository_url) &&
        empty($download_url)
    ) {
        return $content;
    }

    $button_label = get_post_meta(
        $post_id,
        '_tmpizza_github_button_label',
        true
    );

    if (empty($button_label)) {
        $button_label =
            'Letöltés GitHubról';
    }

    ob_start();
    ?>

    <section
        class="project-github-panel"
        aria-label="Projekt letöltése"
    >

        <div class="project-github-panel-text">

            <span class="project-github-eyebrow">
                GitHub
            </span>

            <h2>Próbáld ki a projektet</h2>

            <p>
                Töltsd le a legfrissebb elérhető
                változatot közvetlenül a GitHubról.
            </p>

        </div>


        <div class="project-github-buttons">

            <?php if ($download_url) : ?>

                <a
                    class="
                        project-github-button
                        project-github-button-primary
                    "
                    href="<?php
                    echo esc_url($download_url);
                    ?>"
                >

                    <svg
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            d="M12 3v12m0 0 5-5m-5 5-5-5M5 19h14"
                        />
                    </svg>

                    <?php
                    echo esc_html($button_label);
                    ?>

                </a>

            <?php endif; ?>


            <?php if ($repository_url) : ?>

                <a
                    class="
                        project-github-button
                        project-github-button-secondary
                    "
                    href="<?php
                    echo esc_url($repository_url);
                    ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                >

                    Repository megnyitása

                    <span aria-hidden="true">
                        ↗
                    </span>

                </a>

            <?php endif; ?>

        </div>

    </section>

    <?php

    return $content . ob_get_clean();
}

add_filter(
    'the_content',
    'tmpizza_append_github_project_buttons',
    20
);


/*
==========================================
GitHub stylesheet
==========================================
*/

function tmpizza_github_download_assets() {

    if (!is_singular('tmpizza_project')) {
        return;
    }

    $relative_path =
        '/assets/css/github-downloads.css';

    $absolute_path =
        get_template_directory()
        . $relative_path;

    $version = file_exists($absolute_path)
        ? filemtime($absolute_path)
        : wp_get_theme()->get('Version');

    wp_enqueue_style(
        'tmpizza-github-downloads',
        get_template_directory_uri()
            . $relative_path,
        array('tmpizza-responsive'),
        $version
    );
}

add_action(
    'wp_enqueue_scripts',
    'tmpizza_github_download_assets',
    20
);