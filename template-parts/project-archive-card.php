<?php
/**
 * Project archive card
 *
 * @package TMPizza
 */

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

$platforms = array();

if (!empty($platform_value)) {

    $platforms = array_filter(
        array_map(
            'trim',
            explode(',', $platform_value)
        )
    );
}

$is_featured = get_post_meta(
    $project_id,
    '_tmpizza_project_featured',
    true
) === '1';

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

$summary = has_excerpt()
    ? get_the_excerpt()
    : wp_trim_words(
        wp_strip_all_tags(
            strip_shortcodes(
                get_the_content()
            )
        ),
        24
    );
?>

<article class="archive-project-card reveal">

    <a
        class="archive-project-card__link"
        href="<?php the_permalink(); ?>"
        aria-label="<?php
        echo esc_attr(
            get_the_title() . ' projekt megtekintése'
        );
        ?>"
    >

        <div class="archive-project-card__media">

            <?php if (has_post_thumbnail()) : ?>

                <?php
                the_post_thumbnail(
                    'large',
                    array(
                        'loading' => 'lazy',
                        'alt'     => get_the_title(),
                    )
                );
                ?>

            <?php else : ?>

                <div
                    class="archive-project-card__placeholder"
                    aria-hidden="true"
                >
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

            <?php endif; ?>

            <div
                class="archive-project-card__media-overlay"
                aria-hidden="true"
            ></div>

            <div class="archive-project-card__badges">

                <span class="archive-project-card__status">

                    <i aria-hidden="true"></i>

                    <?php echo esc_html($status_label); ?>

                </span>

                <?php if ($is_featured) : ?>

                    <span class="archive-project-card__featured">
                        ★ Kiemelt
                    </span>

                <?php endif; ?>

            </div>

        </div>

        <div class="archive-project-card__content">

            <?php if (!empty($division_names)) : ?>

                <span class="archive-project-card__division">
                    <?php
                    echo esc_html(
                        implode(' · ', $division_names)
                    );
                    ?>
                </span>

            <?php endif; ?>

            <h3>
                <?php the_title(); ?>
            </h3>

            <?php if (!empty($summary)) : ?>

                <p>
                    <?php echo esc_html($summary); ?>
                </p>

            <?php endif; ?>

            <?php if (!empty($platforms)) : ?>

                <ul class="archive-project-card__platforms">

                    <?php foreach ($platforms as $platform) : ?>

                        <li>
                            <?php echo esc_html($platform); ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php endif; ?>

            <div class="archive-project-card__footer">

                <span>
                    Projekt megtekintése
                </span>

                <strong aria-hidden="true">↗</strong>

            </div>

        </div>

    </a>

</article>