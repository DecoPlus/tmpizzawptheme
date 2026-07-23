<?php
/**
 * Project archive
 *
 * Displays every published project, grouped by division.
 *
 * @package TMPizza
 */

get_header();

$project_counts = wp_count_posts('tmpizza_project');

$published_project_count =
    isset($project_counts->publish)
        ? (int) $project_counts->publish
        : 0;

$division_terms = get_terms(
    array(
        'taxonomy'   => 'tmpizza_division',
        'hide_empty' => true,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

if (is_wp_error($division_terms)) {
    $division_terms = array();
}

/*
Sort projects using the custom display-order field.

Projects with the same order are sorted alphabetically.
*/

$sort_projects = static function ($project_a, $project_b) {

    $order_a = (int) get_post_meta(
        $project_a->ID,
        '_tmpizza_project_order',
        true
    );

    $order_b = (int) get_post_meta(
        $project_b->ID,
        '_tmpizza_project_order',
        true
    );

    if ($order_a === $order_b) {
        return strcasecmp(
            $project_a->post_title,
            $project_b->post_title
        );
    }

    return $order_a <=> $order_b;
};
?>

<main class="project-archive">

    <section class="project-archive-hero">

        <div
            class="project-archive-hero__grid"
            aria-hidden="true"
        ></div>

        <div
            class="project-archive-hero__glow
                   project-archive-hero__glow--red"
            aria-hidden="true"
        ></div>

        <div
            class="project-archive-hero__glow
                   project-archive-hero__glow--orange"
            aria-hidden="true"
        ></div>

        <div class="container">

            <a
                class="project-archive__back"
                href="<?php echo esc_url(home_url('/')); ?>"
            >
                <span aria-hidden="true">←</span>
                Vissza a kezdőlapra
            </a>

            <div class="project-archive-hero__layout">

                <div class="project-archive-hero__content">

                    <span class="section-kicker">
                        TM Pizza projektek
                    </span>

                    <h1>
                        Minden projekt.
                        <span>Egy helyen.</span>
                    </h1>

                    <p>
                        Játékok, filmes produkciók, alkalmazások,
                        technikai kísérletek és minden más,
                        amin a TM Pizza részlegei dolgoznak.
                    </p>

                </div>

                <aside class="project-archive-counter">

                    <span class="project-archive-counter__label">
                        Közzétett projektek
                    </span>

                    <strong>
                        <?php
                        echo esc_html(
                            str_pad(
                                (string) $published_project_count,
                                2,
                                '0',
                                STR_PAD_LEFT
                            )
                        );
                        ?>
                    </strong>

                    <div class="project-archive-counter__status">

                        <span></span>

                        Projektadatbázis elérhető

                    </div>

                </aside>

            </div>

            <?php if (!empty($division_terms)) : ?>

                <nav
                    class="project-archive-navigation"
                    aria-label="Projektrészlegek"
                >

                    <span>Ugrás egy részleghez:</span>

                    <div>

                        <?php foreach ($division_terms as $division_term) : ?>

                            <a
                                href="#division-<?php
                                echo esc_attr($division_term->slug);
                                ?>"
                            >
                                <?php
                                echo esc_html($division_term->name);
                                ?>

                                <small>
                                    <?php
                                    echo esc_html(
                                        (string) $division_term->count
                                    );
                                    ?>
                                </small>
                            </a>

                        <?php endforeach; ?>

                    </div>

                </nav>

            <?php endif; ?>

        </div>

    </section>

    <section class="project-archive-content">

        <div class="container">

            <?php if ($published_project_count > 0) : ?>

                <?php foreach ($division_terms as $division_term) : ?>

                    <?php
                    $division_projects = new WP_Query(
                        array(
                            'post_type'      => 'tmpizza_project',
                            'post_status'    => 'publish',
                            'posts_per_page' => -1,
                            'orderby'        => 'title',
                            'order'          => 'ASC',

                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'tmpizza_division',
                                    'field'    => 'term_id',
                                    'terms'    => $division_term->term_id,
                                ),
                            ),
                        )
                    );

                    if (!$division_projects->have_posts()) {
                        wp_reset_postdata();
                        continue;
                    }

                    usort(
                        $division_projects->posts,
                        $sort_projects
                    );
                    ?>

                    <section
                        class="project-division"
                        id="division-<?php
                        echo esc_attr($division_term->slug);
                        ?>"
                    >

                        <header class="project-division__header reveal">

                            <div>

                                <span class="project-division__number">
                                    <?php
                                    echo esc_html(
                                        str_pad(
                                            (string) (
                                                array_search(
                                                    $division_term,
                                                    $division_terms,
                                                    true
                                                ) + 1
                                            ),
                                            2,
                                            '0',
                                            STR_PAD_LEFT
                                        )
                                    );
                                    ?>
                                </span>

                                <div>

                                    <span class="section-kicker">
                                        Részleg
                                    </span>

                                    <h2>
                                        <?php
                                        echo esc_html(
                                            $division_term->name
                                        );
                                        ?>
                                    </h2>

                                </div>

                            </div>

                            <div class="project-division__summary">

                                <?php
                                if (!empty($division_term->description)) :
                                    ?>

                                    <p>
                                        <?php
                                        echo esc_html(
                                            $division_term->description
                                        );
                                        ?>
                                    </p>

                                <?php else : ?>

                                    <p>
                                        A részleg összes jelenleg
                                        közzétett projektje.
                                    </p>

                                <?php endif; ?>

                                <strong>
                                    <?php
                                    echo esc_html(
                                        (string) count(
                                            $division_projects->posts
                                        )
                                    );
                                    ?>
                                    projekt
                                </strong>

                            </div>

                        </header>

                        <div class="project-archive-grid">

                            <?php
                            while ($division_projects->have_posts()) :
                                $division_projects->the_post();

                                get_template_part(
                                    'template-parts/project',
                                    'archive-card'
                                );

                            endwhile;
                            ?>

                        </div>

                    </section>

                    <?php wp_reset_postdata(); ?>

                <?php endforeach; ?>

                <?php
                /*
                Projects that do not have a division assigned.

                This section guarantees that every published
                project appears somewhere on the archive page.
                */

                $unassigned_projects = new WP_Query(
                    array(
                        'post_type'      => 'tmpizza_project',
                        'post_status'    => 'publish',
                        'posts_per_page' => -1,
                        'orderby'        => 'title',
                        'order'          => 'ASC',

                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tmpizza_division',
                                'operator' => 'NOT EXISTS',
                            ),
                        ),
                    )
                );

                if ($unassigned_projects->have_posts()) :

                    usort(
                        $unassigned_projects->posts,
                        $sort_projects
                    );
                    ?>

                    <section
                        class="project-division"
                        id="division-other"
                    >

                        <header class="project-division__header reveal">

                            <div>

                                <span class="project-division__number">
                                    --
                                </span>

                                <div>

                                    <span class="section-kicker">
                                        Egyéb
                                    </span>

                                    <h2>
                                        Besorolatlan projektek
                                    </h2>

                                </div>

                            </div>

                            <div class="project-division__summary">

                                <p>
                                    Ezekhez a projektekhez még nincs
                                    részleg hozzárendelve.
                                </p>

                                <strong>
                                    <?php
                                    echo esc_html(
                                        (string) count(
                                            $unassigned_projects->posts
                                        )
                                    );
                                    ?>
                                    projekt
                                </strong>

                            </div>

                        </header>

                        <div class="project-archive-grid">

                            <?php
                            while ($unassigned_projects->have_posts()) :
                                $unassigned_projects->the_post();

                                get_template_part(
                                    'template-parts/project',
                                    'archive-card'
                                );

                            endwhile;
                            ?>

                        </div>

                    </section>

                    <?php
                    wp_reset_postdata();

                endif;
                ?>

            <?php else : ?>

                <div class="project-archive-empty">

                    <span aria-hidden="true">×</span>

                    <h2>
                        Még nincs közzétett projekt.
                    </h2>

                    <p>
                        Az első projekt közzététele után
                        automatikusan megjelenik ezen az oldalon.
                    </p>

                    <?php if (current_user_can('edit_posts')) : ?>

                        <a
                            class="button button--primary"
                            href="<?php
                            echo esc_url(
                                admin_url(
                                    'post-new.php'
                                    . '?post_type=tmpizza_project'
                                )
                            );
                            ?>"
                        >
                            Új projekt létrehozása
                        </a>

                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>