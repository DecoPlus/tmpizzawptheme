<?php
/**
 * Site header
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Projektarchívum címe.
 *
 * Ha valamiért még nem érhető el az archívum,
 * visszaesik a kezdőlapi projektszekcióra.
 */

$projects_url = get_post_type_archive_link(
    'tmpizza_project'
);

if (!$projects_url) {
    $projects_url = home_url('/#projects');
}

/*
 * Ide később beillesztheted a Discord-meghívódat.
 *
 * Példa:
 * $discord_url = 'https://discord.gg/abcdefgh';
 *
 * Amíg üres, a kezdőlap csatlakozási részére mutat.
 */

$discord_url = 'https://discord.gg/2JyHYtj3xm';
$github_url  = 'https://github.com/DecoPlus/tmpizzawptheme';

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

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

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
                    href="<?php echo esc_url($discord_href); ?>"
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