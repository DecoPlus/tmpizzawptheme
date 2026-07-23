<?php
/**
 * Site header
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}

$projects_url = get_post_type_archive_link(
    'tmpizza_project'
);

if (!$projects_url) {
    $projects_url = home_url('/#projects');
}

/*
 * Add your Discord invitation here.
 */

$discord_url = '';

$discord_href = $discord_url !== ''
    ? $discord_url
    : home_url('/#join');
?>

<!doctype html>

<html <?php language_attributes(); ?>>

<head>

    <meta charset="<?php bloginfo('charset'); ?>">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <script>
        /*
         * Apply a previously selected device mode
         * before the page is painted.
         */

        (function () {
            try {
                const savedMode = localStorage.getItem(
                    "tmpizza-device-view"
                );

                const allowedModes = [
                    "desktop",
                    "mobile",
                    "tablet"
                ];

                if (allowedModes.includes(savedMode)) {
                    document.documentElement.classList.add(
                        "view-" + savedMode
                    );
                }
            } catch (error) {
                /*
                 * The page still works if localStorage
                 * is unavailable.
                 */
            }
        }());
    </script>

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php
get_template_part(
    'template-parts/device',
    'dilemma'
);
?>

<header class="site-header">

    <div class="container">

        <div class="site-header__inner">

            <a
                class="site-brand site-header__brand"
                href="<?php echo esc_url(home_url('/')); ?>"
                aria-label="TM Pizza kezdőlap"
            >

                <span
                    class="site-brand__dot"
                    aria-hidden="true"
                ></span>

                <span class="site-brand__text">
                    TM Pizza
                </span>

            </a>

            <nav
                class="site-navigation"
                id="primary-navigation"
                aria-label="Elsődleges navigáció"
            >

                <a
                    href="<?php
                    echo esc_url(
                        home_url('/#divisions')
                    );
                    ?>"
                >
                    Részlegek
                </a>

                <a
                    href="<?php
                    echo esc_url($projects_url);
                    ?>"
                >
                    Projektek
                </a>

                <a
                    href="<?php
                    echo esc_url(
                        home_url('/#about')
                    );
                    ?>"
                >
                    Rólunk
                </a>

                <a
                    href="<?php
                    echo esc_url(
                        home_url('/#join')
                    );
                    ?>"
                >
                    Csatlakozás
                </a>

            </nav>

            <div class="site-header__actions">

                <a
                    class="
                        site-header__cta
                        header-cta
                        button
                        button--primary
                    "
                    href="<?php
                    echo esc_url($discord_href);
                    ?>"
                    <?php if ($discord_url !== '') : ?>
                        target="_blank"
                        rel="noopener noreferrer"
                    <?php endif; ?>
                >
                    Discord

                    <span aria-hidden="true">
                        ↗
                    </span>
                </a>

                <button
                    class="mobile-menu-toggle"
                    type="button"
                    aria-controls="primary-navigation"
                    aria-expanded="false"
                    aria-label="Menü megnyitása"
                >

                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>

                </button>

            </div>

        </div>

    </div>

</header>