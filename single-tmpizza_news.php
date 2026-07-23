<?php
/**
 * Single Newsroom post
 *
 * @package TMPizza
 */

get_header();
?>

<main class="newsroom-single-page">

    <?php while (have_posts()) : ?>

        <?php the_post(); ?>

        <article
            <?php post_class('newsroom-single'); ?>
        >

            <header class="newsroom-single-header">

                <div class="newsroom-single-glow"></div>

                <div class="newsroom-single-container">

                    <a
                        class="newsroom-back-link"
                        href="<?php
                        echo esc_url(
                            get_post_type_archive_link(
                                'tmpizza_news'
                            )
                        );
                        ?>"
                    >
                        ← Vissza a Newsroomhoz
                    </a>


                    <div class="newsroom-single-meta">

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


                    <h1><?php the_title(); ?></h1>


                    <?php if (has_excerpt()) : ?>

                        <p class="newsroom-single-intro">
                            <?php
                            echo esc_html(
                                get_the_excerpt()
                            );
                            ?>
                        </p>

                    <?php endif; ?>

                </div>

            </header>


            <div class="newsroom-single-container">

                <?php if (has_post_thumbnail()) : ?>

                    <figure class="newsroom-single-image">

                        <?php
                        the_post_thumbnail(
                            'full',
                            array(
                                'loading' => 'eager',
                            )
                        );
                        ?>

                    </figure>

                <?php endif; ?>


                <div class="newsroom-single-content">

                    <?php the_content(); ?>

                </div>


                <footer class="newsroom-single-footer">

                    <a
                        class="newsroom-back-button"
                        href="<?php
                        echo esc_url(
                            get_post_type_archive_link(
                                'tmpizza_news'
                            )
                        );
                        ?>"
                    >
                        ← További frissítések
                    </a>

                </footer>

            </div>

        </article>

    <?php endwhile; ?>

</main>

<?php
get_footer();