<!DOCTYPE html>
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

<header class="site-header" id="site-header">

    <div class="site-header__inner">

        <a
            class="site-logo"
            href="<?php echo esc_url(home_url('/')); ?>"
            aria-label="TM Pizza kezdőlap"
        >
            <span class="site-logo__mark"></span>
            <span class="site-logo__text">TM Pizza</span>
        </a>

        <nav
            class="site-navigation"
            aria-label="Fő navigáció"
        >
            <a href="#divisions">Részlegek</a>
            <a href="#projects">Projektek</a>
            <a href="#about">Rólunk</a>
            <a href="#join">Csatlakozás</a>
        </nav>

        <a class="nav-discord" href="#join">
            Discord
            <span aria-hidden="true">↗</span>
        </a>

        <button
            class="mobile-menu-toggle"
            type="button"
            aria-label="Menü megnyitása"
            aria-expanded="false"
        >
            <span></span>
            <span></span>
        </button>

    </div>

</header>