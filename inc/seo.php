<?php
/**
 * TM Pizza SEO and social metadata
 *
 * @package TMPizza
 */

if (!defined('ABSPATH')) {
    exit;
}


/*
==========================================
Page description
==========================================
*/

function tmpizza_get_meta_description() {

    $default_description =
        'A TM Pizza egy kreatív közösség, ahol játékok, filmek, '
        . 'alkalmazások és technikai projektek készülnek. '
        . 'Fedezd fel részlegeinket és munkáinkat.';


    /*
    Individual project or normal page
    */

    if (is_singular()) {

        $post_id = get_queried_object_id();

        if ($post_id) {

            if (has_excerpt($post_id)) {

                $description =
                    get_the_excerpt($post_id);

            } else {

                $content = get_post_field(
                    'post_content',
                    $post_id
                );

                $description = wp_trim_words(
                    wp_strip_all_tags(
                        strip_shortcodes($content)
                    ),
                    30,
                    '…'
                );
            }

            $description = preg_replace(
                '/\s+/',
                ' ',
                trim($description)
            );

            if (!empty($description)) {
                return $description;
            }
        }
    }


    /*
    Project archive
    */

    if (
        is_post_type_archive(
            'tmpizza_project'
        )
    ) {
        return
            'Fedezd fel a TM Pizza összes játék-, film- és '
            . 'workshopprojektjét részlegek szerint rendezve.';
    }


    /*
    Project division archive
    */

    if (
        is_tax(
            'tmpizza_division'
        )
    ) {

        $term = get_queried_object();

        if (
            $term instanceof WP_Term &&
            !empty($term->description)
        ) {
            return preg_replace(
                '/\s+/',
                ' ',
                wp_strip_all_tags(
                    $term->description
                )
            );
        }

        if ($term instanceof WP_Term) {
            return sprintf(
                'A TM Pizza %s részlegének projektjei és munkái.',
                $term->name
            );
        }
    }

    return $default_description;
}


/*
==========================================
Current page URL
==========================================
*/

function tmpizza_get_current_page_url() {

    if (is_singular()) {

        $permalink = get_permalink();

        if ($permalink) {
            return $permalink;
        }
    }

    if (is_front_page() || is_home()) {
        return home_url('/');
    }

    if (
        is_post_type_archive(
            'tmpizza_project'
        )
    ) {

        $archive_url = get_post_type_archive_link(
            'tmpizza_project'
        );

        if ($archive_url) {
            return $archive_url;
        }
    }

    if (
        is_tax(
            'tmpizza_division'
        )
    ) {

        $term_url = get_term_link(
            get_queried_object()
        );

        if (!is_wp_error($term_url)) {
            return $term_url;
        }
    }

    global $wp;

    if (
        isset($wp->request) &&
        $wp->request !== ''
    ) {
        return home_url(
            '/' . ltrim(
                $wp->request,
                '/'
            )
        );
    }

    return home_url('/');
}


/*
==========================================
Social preview image
==========================================
*/

function tmpizza_get_social_image() {

    /*
    Use project featured image first
    */

    if (is_singular()) {

        $post_id = get_queried_object_id();

        if (
            $post_id &&
            has_post_thumbnail($post_id)
        ) {

            $thumbnail_id =
                get_post_thumbnail_id($post_id);

            $image = wp_get_attachment_image_src(
                $thumbnail_id,
                'full'
            );

            if ($image) {

                $image_alt = get_post_meta(
                    $thumbnail_id,
                    '_wp_attachment_image_alt',
                    true
                );

                if (empty($image_alt)) {
                    $image_alt = get_the_title(
                        $post_id
                    );
                }

                return array(
                    'url'    => $image[0],
                    'width'  => $image[1],
                    'height' => $image[2],
                    'alt'    => $image_alt,
                );
            }
        }
    }


    /*
    Default 1200 × 630 preview
    */

    $fallback_path =
        get_template_directory()
        . '/assets/images/social-preview.jpg';

    $fallback_url =
        get_template_directory_uri()
        . '/assets/images/social-preview.jpg';

    if (file_exists($fallback_path)) {

        return array(
            'url'    => $fallback_url,
            'width'  => 1200,
            'height' => 630,
            'alt'    => 'TM Pizza – játékok, filmek és kreatív projektek',
        );
    }


    /*
    Fall back to the WordPress Site Icon
    */

    $site_icon = get_site_icon_url(512);

    if ($site_icon) {

        return array(
            'url'    => $site_icon,
            'width'  => 512,
            'height' => 512,
            'alt'    => get_bloginfo('name'),
        );
    }

    return null;
}


/*
==========================================
Meta and Open Graph tags
==========================================
*/

function tmpizza_output_seo_meta() {

    if (is_admin() || is_feed()) {
        return;
    }

    $title =
        wp_get_document_title();

    $description =
        tmpizza_get_meta_description();

    $page_url =
        tmpizza_get_current_page_url();

    $site_name =
        get_bloginfo('name');

    $social_image =
        tmpizza_get_social_image();

    $og_type =
        is_singular('tmpizza_project')
            ? 'article'
            : 'website';

    ?>

    <!-- TM Pizza SEO -->

    <meta
        name="description"
        content="<?php
        echo esc_attr($description);
        ?>"
    >

    <meta
        name="theme-color"
        content="#080808"
    >

    <meta
        property="og:locale"
        content="<?php
        echo esc_attr(get_locale());
        ?>"
    >

    <meta
        property="og:type"
        content="<?php
        echo esc_attr($og_type);
        ?>"
    >

    <meta
        property="og:site_name"
        content="<?php
        echo esc_attr($site_name);
        ?>"
    >

    <meta
        property="og:title"
        content="<?php
        echo esc_attr($title);
        ?>"
    >

    <meta
        property="og:description"
        content="<?php
        echo esc_attr($description);
        ?>"
    >

    <meta
        property="og:url"
        content="<?php
        echo esc_url($page_url);
        ?>"
    >

    <?php if ($social_image) : ?>

        <meta
            property="og:image"
            content="<?php
            echo esc_url(
                $social_image['url']
            );
            ?>"
        >

        <meta
            property="og:image:secure_url"
            content="<?php
            echo esc_url(
                $social_image['url']
            );
            ?>"
        >

        <meta
            property="og:image:width"
            content="<?php
            echo esc_attr(
                (string) $social_image['width']
            );
            ?>"
        >

        <meta
            property="og:image:height"
            content="<?php
            echo esc_attr(
                (string) $social_image['height']
            );
            ?>"
        >

        <meta
            property="og:image:alt"
            content="<?php
            echo esc_attr(
                $social_image['alt']
            );
            ?>"
        >

    <?php endif; ?>


    <!-- X / Twitter card -->

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="<?php
        echo esc_attr($title);
        ?>"
    >

    <meta
        name="twitter:description"
        content="<?php
        echo esc_attr($description);
        ?>"
    >

    <?php if ($social_image) : ?>

        <meta
            name="twitter:image"
            content="<?php
            echo esc_url(
                $social_image['url']
            );
            ?>"
        >

        <meta
            name="twitter:image:alt"
            content="<?php
            echo esc_attr(
                $social_image['alt']
            );
            ?>"
        >

    <?php endif; ?>

    <?php
}

add_action(
    'wp_head',
    'tmpizza_output_seo_meta',
    2
);


/*
==========================================
Google site-name structured data
==========================================
*/

function tmpizza_output_website_schema() {

    if (!is_front_page()) {
        return;
    }

    $home_url =
        home_url('/');

    $organization_id =
        $home_url . '#organization';

    $website_id =
        $home_url . '#website';

    $organization = array(
        '@type' => 'Organization',
        '@id'   => $organization_id,
        'name'  => get_bloginfo('name'),
        'url'   => $home_url,
    );

    $site_icon = get_site_icon_url(512);

    if ($site_icon) {

        $organization['logo'] = array(
            '@type'  => 'ImageObject',
            'url'    => $site_icon,
            'width'  => 512,
            'height' => 512,
        );
    }

    $website = array(
        '@type'       => 'WebSite',
        '@id'         => $website_id,
        'url'         => $home_url,
        'name'        => 'TM Pizza',
        'alternateName' => 'TM Pizza Studio',
        'description' =>
            tmpizza_get_meta_description(),
        'inLanguage'  =>
            get_bloginfo('language'),
        'publisher'   => array(
            '@id' => $organization_id,
        ),
    );

    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array(
            $organization,
            $website,
        ),
    );

    ?>

    <script type="application/ld+json">
        <?php
        echo wp_json_encode(
            $schema,
            JSON_UNESCAPED_SLASHES
            | JSON_UNESCAPED_UNICODE
        );
        ?>
    </script>

    <?php
}

add_action(
    'wp_head',
    'tmpizza_output_website_schema',
    3
);