<?php
/**
 * Single project template
 *
 * @package TMPizza
 */

get_header();

while (have_posts()) :
    the_post();

    $project_id = get_the_ID();

    $status_key = get_post_meta(
        $project_id,
        '_tmpizza_project_status',
        true
    );

    $statuses = function_exists('tmpizza_project_statuses')
        ? tmpizza_project_statuses()
        : array();

    $status_label = isset($statuses[$status_key])
        ? $statuses[$status_key]
        : 'Projekt';

    $platform_value = get_post_meta(
        $project_id,
        '_tmpizza_project_platform',
        true
    );

    $project_url = get_post_meta(
        $project_id,
        '_tmpizza_project_url',
        true
    );

    $is_featured = get_post_meta(
        $project_id,
        '_tmpizza_project_featured',
        true
    ) === '1';

    $platforms = array();

    if (!empty($platform_value)) {
        $platforms = array_filter(
            array_map(
                'trim',
                explode(',', $platform_value)
            )
        );
    }

    $division_terms = get_the_terms(
        $project_id,
        'tmpizza_division'
    );

    $division_names = array();

    if (
        !empty($division_terms) &&
        !is_wp_error($division_terms)
    ) {
        foreach ($division_terms as $division_term) {
            $division_names[] = $division_term->name;
        }
    }

    $project_summary = has_excerpt()
        ? get_the_excerpt()
        : wp_trim_words(
            wp_strip_all_tags(
                strip_shortcodes(
                    get_the_content()
                )
            ),
            32
        );

    $thumbnail_url = get_the_post_thumbnail_url(
        $project_id,
        'full'
    );
    ?>

    <main class="single-project">

        <section class="single-project-hero">

            <div class="single-project-hero__media">

                <?php if ($thumbnail_url) : ?>

                    <img
                        src="<?php echo esc_url($thumbnail_url); ?>"
                        alt="<?php echo esc_attr(get_the_title()); ?>"
                    >

                <?php else : ?>

                    <div
                        class="single-project-hero__placeholder"
                        aria-hidden="true"
                    >
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                <?php endif; ?>

            </div>

            <div
                class="single-project-hero__overlay"
                aria-hidden="true"
            ></div>

            <div
                class="single-project-hero__grid"
                aria-hidden="true"
            ></div>

            <div class="container">

                <a
                    class="single-project__back"
                    href="<?php echo esc_url(home_url('/#projects')); ?>"
                >
                    <span aria-hidden="true">←</span>
                    Vissza a projektekhez
                </a>

                <div class="single-project-hero__content">

                    <div class="single-project__badges">

                        <?php if ($is_featured) : ?>

                            <span class="single-project__badge">
                                ★ Kiemelt projekt
                            </span>

                        <?php endif; ?>

                        <?php foreach ($division_names as $division_name) : ?>

                            <span
                                class="
                                    single-project__badge
                                    single-project__badge--division
                                "
                            >
                                <?php echo esc_html($division_name); ?>
                            </span>

                        <?php endforeach; ?>

                    </div>

                    <h1>
                        <?php the_title(); ?>
                    </h1>

                    <?php if (!empty($project_summary)) : ?>

                        <p class="single-project-hero__summary">
                            <?php echo esc_html($project_summary); ?>
                        </p>

                    <?php endif; ?>

                    <div class="single-project-hero__actions">

                        <a
                            class="button button--primary"
                            href="#project-content"
                        >
                            Projekt részletei
                            <span aria-hidden="true">↓</span>
                        </a>

                        <?php if (!empty($project_url)) : ?>

                            <a
                                class="button button--glass"
                                href="<?php echo esc_url($project_url); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Projekt megnyitása
                                <span aria-hidden="true">↗</span>
                            </a>

                        <?php endif; ?>

                    </div>

                </div>

                <div class="single-project-hero__meta">

                    <article class="single-project-meta-card">

                        <span>Állapot</span>

                        <strong>
                            <i aria-hidden="true"></i>
                            <?php echo esc_html($status_label); ?>
                        </strong>

                    </article>

                    <article class="single-project-meta-card">

                        <span>Részleg</span>

                        <strong>
                            <?php
                            echo !empty($division_names)
                                ? esc_html(
                                    implode(', ', $division_names)
                                )
                                : 'TM Pizza';
                            ?>
                        </strong>

                    </article>

                    <article class="single-project-meta-card">

                        <span>Platform</span>

                        <strong>
                            <?php
                            echo !empty($platforms)
                                ? esc_html(
                                    implode(', ', $platforms)
                                )
                                : 'Nincs megadva';
                            ?>
                        </strong>

                    </article>

                </div>

            </div>

        </section>

        <section
            class="single-project-content"
            id="project-content"
        >

            <div class="container">

                <div class="single-project-content__layout">

                    <article class="single-project-article">

                        <span class="section-kicker">
                            A projektről
                        </span>

                        <div class="single-project-article__body">

                            <?php the_content(); ?>

                        </div>

                    </article>

                    <aside class="single-project-sidebar">

                        <div class="single-project-info">

                            <span class="single-project-info__label">
                                Projektadatok
                            </span>

                            <dl>

                                <div>
                                    <dt>Projekt neve</dt>

                                    <dd>
                                        <?php the_title(); ?>
                                    </dd>
                                </div>

                                <div>
                                    <dt>Állapot</dt>

                                    <dd>
                                        <?php
                                        echo esc_html($status_label);
                                        ?>
                                    </dd>
                                </div>

                                <div>
                                    <dt>Részleg</dt>

                                    <dd>
                                        <?php
                                        echo !empty($division_names)
                                            ? esc_html(
                                                implode(
                                                    ', ',
                                                    $division_names
                                                )
                                            )
                                            : 'Nincs megadva';
                                        ?>
                                    </dd>
                                </div>

                                <div>
                                    <dt>Platform</dt>

                                    <dd>
                                        <?php
                                        echo !empty($platforms)
                                            ? esc_html(
                                                implode(
                                                    ', ',
                                                    $platforms
                                                )
                                            )
                                            : 'Nincs megadva';
                                        ?>
                                    </dd>
                                </div>

                            </dl>

                            <?php if (!empty($project_url)) : ?>

                                <a
                                    class="single-project-info__link"
                                    href="<?php echo esc_url($project_url); ?>"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    Projekt megnyitása
                                    <span aria-hidden="true">↗</span>
                                </a>

                            <?php endif; ?>

                        </div>

                        <div class="single-project-sidebar__note">

                            <span></span>

                            <p>
                                Ez a projekt a TM Pizza egyik
                                közösségi alkotása.
                            </p>

                        </div>

                    </aside>

                </div>

                <div class="single-project-bottom">

                    <div>

                        <span>További projektek</span>

                        <h2>
                            Nézd meg, min dolgozunk még.
                        </h2>

                    </div>

                    <a
                        class="button button--glass"
                        href="<?php echo esc_url(home_url('/#projects')); ?>"
                    >
                        Összes projekt
                        <span aria-hidden="true">→</span>
                    </a>

                </div>

            </div>

        </section>

    </main>

<?php
endwhile;

get_footer();