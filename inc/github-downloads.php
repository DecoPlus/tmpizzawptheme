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
Add project GitHub meta box
==========================================
*/

function tmpizza_add_github_download_meta_box() {

    add_meta_box(
        'tmpizza-github-download',
        'GitHub-letöltés',
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


/*
==========================================
Render project GitHub meta box
==========================================
*/

function tmpizza_render_github_download_meta_box(
    $post
) {

    wp_nonce_field(
        'tmpizza_save_github_download',
        'tmpizza_github_download_nonce'
    );

    $download_enabled = get_post_meta(
        $post->ID,
        '_tmpizza_github_download_enabled',
        true
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

    if (empty($branch)) {
        $branch = 'main';
    }

    ?>

    <div class="tmpizza-github-admin">

        <p>

            <label>

                <input
                    type="checkbox"
                    name="tmpizza_github_download_enabled"
                    value="yes"
                    <?php
                    checked(
                        $download_enabled,
                        'yes'
                    );
                    ?>
                >

                <strong>
                    A projekt letölthető GitHubról
                </strong>

            </label>

        </p>

        <p class="description">
            A letöltési gomb csak akkor jelenik meg,
            ha ezt bepipálod, és repository-linket is
            megadsz.
        </p>


        <hr style="margin:24px 0;">


        <p>

            <label
                for="tmpizza-github-repository-url"
            >
                <strong>
                    GitHub repository linkje
                </strong>
            </label>

        </p>

        <input
            id="tmpizza-github-repository-url"
            name="tmpizza_github_repository_url"
            type="url"
            class="widefat"
            value="<?php
            echo esc_attr(
                $repository_url
            );
            ?>"
            placeholder="https://github.com/felhasznalonev/projekt"
        >

        <p class="description">
            Példa:
            https://github.com/TMPizzaStudio/BpM
        </p>


        <p style="margin-top:24px;">

            <label
                for="tmpizza-github-branch"
            >
                <strong>
                    Letölthető branch
                </strong>
            </label>

        </p>

        <input
            id="tmpizza-github-branch"
            name="tmpizza_github_branch"
            type="text"
            class="regular-text"
            value="<?php
            echo esc_attr(
                $branch
            );
            ?>"
            placeholder="main"
        >

        <p class="description">
            Ez általában
            <code>main</code>.
            Régebbi repositoryknál lehet
            <code>master</code>.
        </p>

    </div>

    <?php
}


/*
==========================================
Normalize and validate GitHub repository URL
==========================================
*/

function tmpizza_sanitize_github_repository_url(
    $url
) {

    $url = esc_url_raw(
        trim(
            (string) $url
        )
    );

    if (empty($url)) {
        return '';
    }

    $scheme = strtolower(
        (string) wp_parse_url(
            $url,
            PHP_URL_SCHEME
        )
    );

    $host = strtolower(
        (string) wp_parse_url(
            $url,
            PHP_URL_HOST
        )
    );

    $path = trim(
        (string) wp_parse_url(
            $url,
            PHP_URL_PATH
        ),
        '/'
    );

    if ($scheme !== 'https') {
        return '';
    }

    if (
        $host !== 'github.com' &&
        $host !== 'www.github.com'
    ) {
        return '';
    }

    $path = preg_replace(
        '/\.git$/i',
        '',
        $path
    );

    $path_parts = array_values(
        array_filter(
            explode(
                '/',
                $path
            )
        )
    );

    /*
     * A repository link must contain at least:
     *
     * owner/repository
     */

    if (count($path_parts) < 2) {
        return '';
    }

    $owner = sanitize_title(
        $path_parts[0]
    );

    $repository = sanitize_title(
        $path_parts[1]
    );

    if (
        empty($owner) ||
        empty($repository)
    ) {
        return '';
    }

    return sprintf(
        'https://github.com/%s/%s',
        rawurlencode($owner),
        rawurlencode($repository)
    );
}


/*
==========================================
Sanitize GitHub branch
==========================================
*/

function tmpizza_sanitize_github_branch(
    $branch
) {

    $branch = trim(
        sanitize_text_field(
            (string) $branch
        )
    );

    if (empty($branch)) {
        return 'main';
    }

    /*
     * Git branch names may contain:
     *
     * letters
     * numbers
     * dots
     * underscores
     * hyphens
     * forward slashes
     */

    if (
        !preg_match(
            '/^[A-Za-z0-9._\/-]+$/',
            $branch
        )
    ) {
        return 'main';
    }

    return $branch;
}


/*
==========================================
Save project GitHub fields
==========================================
*/

function tmpizza_save_github_download_meta(
    $post_id
) {

    if (
        !isset(
            $_POST[
                'tmpizza_github_download_nonce'
            ]
        )
    ) {
        return;
    }

    $nonce = sanitize_text_field(
        wp_unslash(
            $_POST[
                'tmpizza_github_download_nonce'
            ]
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
    Download enabled
    */

    $download_enabled = isset(
        $_POST[
            'tmpizza_github_download_enabled'
        ]
    )
        ? 'yes'
        : 'no';

    update_post_meta(
        $post_id,
        '_tmpizza_github_download_enabled',
        $download_enabled
    );


    /*
    Repository URL
    */

    $repository_url = isset(
        $_POST[
            'tmpizza_github_repository_url'
        ]
    )
        ? tmpizza_sanitize_github_repository_url(
            wp_unslash(
                $_POST[
                    'tmpizza_github_repository_url'
                ]
            )
        )
        : '';

    if (!empty($repository_url)) {

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
        $_POST[
            'tmpizza_github_branch'
        ]
    )
        ? tmpizza_sanitize_github_branch(
            wp_unslash(
                $_POST[
                    'tmpizza_github_branch'
                ]
            )
        )
        : 'main';

    update_post_meta(
        $post_id,
        '_tmpizza_github_branch',
        $branch
    );
}

add_action(
    'save_post_tmpizza_project',
    'tmpizza_save_github_download_meta'
);


/*
==========================================
Get repository URL
==========================================
*/

function tmpizza_get_github_repository_url(
    $post_id
) {

    $repository_url = get_post_meta(
        $post_id,
        '_tmpizza_github_repository_url',
        true
    );

    if (empty($repository_url)) {
        return '';
    }

    return tmpizza_sanitize_github_repository_url(
        $repository_url
    );
}


/*
==========================================
Build GitHub ZIP download URL
==========================================
*/

function tmpizza_get_github_download_url(
    $post_id
) {

    $download_enabled = get_post_meta(
        $post_id,
        '_tmpizza_github_download_enabled',
        true
    );

    if ($download_enabled !== 'yes') {
        return '';
    }

    $repository_url =
        tmpizza_get_github_repository_url(
            $post_id
        );

    if (empty($repository_url)) {
        return '';
    }

    $branch = get_post_meta(
        $post_id,
        '_tmpizza_github_branch',
        true
    );

    $branch =
        tmpizza_sanitize_github_branch(
            $branch
        );

    /*
     * Encode the branch while retaining
     * forward slashes used in branch names.
     */

    $encoded_branch = str_replace(
        '%2F',
        '/',
        rawurlencode($branch)
    );

    return untrailingslashit(
        $repository_url
    )
        . '/archive/refs/heads/'
        . $encoded_branch
        . '.zip';
}


/*
==========================================
Append GitHub buttons to project page
==========================================
*/

function tmpizza_append_github_project_buttons(
    $content
) {

    if (
        !is_singular(
            'tmpizza_project'
        ) ||
        !in_the_loop() ||
        !is_main_query()
    ) {
        return $content;
    }

    $post_id = get_the_ID();

    $download_enabled = get_post_meta(
        $post_id,
        '_tmpizza_github_download_enabled',
        true
    );

    if ($download_enabled !== 'yes') {
        return $content;
    }

    $repository_url =
        tmpizza_get_github_repository_url(
            $post_id
        );

    $download_url =
        tmpizza_get_github_download_url(
            $post_id
        );

    if (
        empty($repository_url) ||
        empty($download_url)
    ) {
        return $content;
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

            <h2>
                Töltsd le a projektet
            </h2>

            <p>
                A projekt legfrissebb elérhető
                forráskódját közvetlenül a
                GitHubról töltheted le.
            </p>

        </div>


        <div class="project-github-buttons">

            <a
                class="
                    project-github-button
                    project-github-button-primary
                "
                href="<?php
                echo esc_url(
                    $download_url
                );
                ?>"
            >

                <svg
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        d="
                            M12 3v12
                            m0 0 5-5
                            m-5 5-5-5
                            M5 19h14
                        "
                    />
                </svg>

                Letöltés GitHubról

            </a>


            <a
                class="
                    project-github-button
                    project-github-button-secondary
                "
                href="<?php
                echo esc_url(
                    $repository_url
                );
                ?>"
                target="_blank"
                rel="noopener noreferrer"
            >

                Repository megnyitása

                <span aria-hidden="true">
                    ↗
                </span>

            </a>

        </div>

    </section>

    <?php

    return $content
        . ob_get_clean();
}

add_filter(
    'the_content',
    'tmpizza_append_github_project_buttons',
    20
);


/*
==========================================
Load GitHub download stylesheet
==========================================
*/

function tmpizza_github_download_assets() {

    if (
        !is_singular(
            'tmpizza_project'
        )
    ) {
        return;
    }

    $relative_path =
        '/assets/css/github-downloads.css';

    $absolute_path =
        get_template_directory()
        . $relative_path;

    $version = file_exists(
        $absolute_path
    )
        ? filemtime(
            $absolute_path
        )
        : wp_get_theme()->get('Version');

    wp_enqueue_style(
        'tmpizza-github-downloads',
        get_template_directory_uri()
            . $relative_path,
        array(
            'tmpizza-responsive',
        ),
        $version
    );
}

add_action(
    'wp_enqueue_scripts',
    'tmpizza_github_download_assets',
    20
);