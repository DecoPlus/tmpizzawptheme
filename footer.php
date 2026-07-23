<?php
/**
 * Site footer
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

$discord_url = '';
$github_url  = '';

$discord_href = $discord_url !== ''
    ? $discord_url
    : home_url('/#join');

$footer_divisions = get_terms(
    array(
        'taxonomy'   => 'tmpizza_division',
        'hide_empty' => false,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

if (is_wp_error($footer_divisions)) {
    $footer_divisions = array();
}
?>

<footer class="site-footer">

    <div class="container">

        <div class="site-footer__top">

            <div class="site-footer__brand">

                <a
                    class="site-footer__logo"
                    href="<?php
                    echo esc_url(home_url('/'));
                    ?>"
                    aria-label="TM Pizza kezdőlap"
                >

                    <span aria-hidden="true"></span>

                    TM Pizza

                </a>

                <p>
                    Játékok, filmek és kreatív projektek
                    egy közösségben.
                </p>

            </div>

            <div class="site-footer__navigation">

                <div class="site-footer__column">

                    <span>Felfedezés</span>

                    <a
                        href="<?php
                        echo esc_url(home_url('/'));
                        ?>"
                    >
                        Kezdőlap
                    </a>

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

                </div>

                <div class="site-footer__column">

                    <span>Közösség</span>

                    <a
                        href="<?php
                        echo esc_url($discord_href);
                        ?>"
                        <?php if ($discord_url !== '') : ?>
                            target="_blank"
                            rel="noopener noreferrer"
                        <?php endif; ?>
                    >
                        Discord ↗
                    </a>

                    <?php if ($github_url !== '') : ?>

                        <a
                            href="<?php
                            echo esc_url($github_url);
                            ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                        >
                            GitHub ↗
                        </a>

                    <?php endif; ?>

                    <a
                        href="<?php
                        echo esc_url(
                            home_url('/#join')
                        );
                        ?>"
                    >
                        Csatlakozás
                    </a>

                </div>

                <div class="site-footer__column">

                    <span>Részlegek</span>

                    <?php if (!empty($footer_divisions)) : ?>

                        <?php
                        foreach (
                            $footer_divisions as $footer_division
                        ) :
                            ?>

                            <a
                                href="<?php
                                echo esc_url(
                                    $projects_url
                                    . '#division-'
                                    . $footer_division->slug
                                );
                                ?>"
                            >
                                <?php
                                echo esc_html(
                                    $footer_division->name
                                );
                                ?>
                            </a>

                        <?php endforeach; ?>

                    <?php else : ?>

                        <a
                            href="<?php
                            echo esc_url(
                                home_url('/#divisions')
                            );
                            ?>"
                        >
                            The Monitor Pixel
                        </a>

                        <a
                            href="<?php
                            echo esc_url(
                                home_url('/#divisions')
                            );
                            ?>"
                        >
                            Tárcsa Productions
                        </a>

                        <a
                            href="<?php
                            echo esc_url(
                                home_url('/#divisions')
                            );
                            ?>"
                        >
                            Workshop
                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <div class="site-footer__bottom">

            <p>
                © <?php echo esc_html(wp_date('Y')); ?>
                TM Pizza. Minden jog fenntartva.
            </p>

            <div class="site-footer__status">

                <span aria-hidden="true"></span>

                <p>
                    A weboldal saját WordPress témával működik
                </p>

            </div>

            <div class="site-footer__bottom-actions">

                <button
                    class="site-footer__view-switch"
                    type="button"
                    data-device-reset
                >
                    Nézet módosítása
                </button>

                <a
                    href="<?php
                    echo esc_url(
                        home_url('/#home')
                    );
                    ?>"
                >
                    Vissza az elejére ↑
                </a>

            </div>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>

</html>