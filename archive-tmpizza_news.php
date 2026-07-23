<?php
/**
 * Newsroom archive
 *
 * @package TMPizza
 */

get_header();
?>

<main class="newsroom-page">

    <section class="newsroom-hero">

        <div class="newsroom-hero-glow"></div>

        <div class="newsroom-container">

            <span class="newsroom-eyebrow">
                TM Pizza
            </span>

            <h1>Newsroom</h1>

            <p>
                Frissítések, bejelentések és kulisszák mögötti
                infók a TM Pizza projektjeiről.
            </p>

        </div>

    </section>


    <section class="newsroom-content">

        <div class="newsroom-container">

            <?php if (have_posts()) : ?>

                <div class="newsroom-grid">

                    <?php while (have_posts()) : ?>

                        <?php the_post(); ?>

                        <article
                            <?php post_class('newsroom-card'); ?>
                        >

                            <a
                                class="newsroom-card-image"
                                href="<?php the_permalink(); ?>"
                                aria-label="<?php
                                echo esc_attr(
                                    get_the_title()
                                );
                                ?>"
                            >

                                <?php if (has_post_thumbnail()) : ?>

                                    <?php
                                    the_post_thumbnail(
                                        'large',
                                        array(
                                            'loading' => 'lazy',
                                        )
                                    );
                                    ?>

                                <?php else : ?>

                                    <div
                                        class="newsroom-card-placeholder"
                                    >
                                        <span>TM</span>
                                    </div>

                                <?php endif; ?>

                            </a>


                            <div class="newsroom-card-body">

                                <div class="newsroom-card-meta">

                                    <time
                                        datetime="<?php
                                        echo esc_attr(
                                            get_the_date('c')
                                        );
                                        ?>"
                                    >
                                        <?php
                                        echo esc_html(
                                            get_the_date()
                                        );
                                        ?>
                                    </time>

                                    <span aria-hidden="true">•</span>

                                    <span>
                                        <?php
                                        echo esc_html(
                                            get_the_author()
                                        );
                                        ?>
                                    </span>

                                </div>


                                <h2>

                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a>

                                </h2>


                                <div class="newsroom-card-excerpt">

                                    <?php
                                    if (has_excerpt()) {
                                        the_excerpt();
                                    } else {
                                        echo wp_kses_post(
                                            wpautop(
                                                wp_trim_words(
                                                    get_the_content(),
                                                    26,
                                                    '…'
                                                )
                                            )
                                        );
                                    }
                                    ?>

                                </div>


                                <a
                                    class="newsroom-read-more"
                                    href="<?php the_permalink(); ?>"
                                >
                                    Frissítés elolvasása

                                    <span aria-hidden="true">
                                        →
                                    </span>
                                </a>

                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>


                <div class="newsroom-pagination">

                    <?php
                    the_posts_pagination(
                        array(
                            'mid_size'  => 1,
                            'prev_text' => '← Előző',
                            'next_text' => 'Következő →',
                        )
                    );
                    ?>

                </div>

            <?php else : ?>

                <div class="newsroom-empty">

                    <span class="newsroom-empty-icon">
                        ◌
                    </span>

                    <h2>Még nincs newsroom frissítés</h2>

                    <p>
                        Amint történik valami izgalmas,
                        itt fog megjelenni.
                    </p>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php
get_footer();