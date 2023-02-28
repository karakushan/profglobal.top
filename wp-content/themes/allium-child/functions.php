<?php
add_action('wp_enqueue_scripts', 'ac_theme_enqueue_styles');
function ac_theme_enqueue_styles()
{
    $parenthandle = 'allium-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style($parenthandle,
        get_template_directory_uri() . '/style.css',
        array(),  // If the parent theme code has a dependency, copy it to here.
        $theme->parent()->get('Version')
    );
    wp_enqueue_style('allium-child-style',
        get_stylesheet_uri(),
        array($parenthandle),
        $theme->get('Version') // This only works if you have Version defined in the style header.
    );
}

/**
 * Set up My Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be added to the /languages/ directory.
 */
function alium_child_theme_setup()
{
    load_child_theme_textdomain('allium-child', get_stylesheet_directory() . '/languages');
}

add_action('after_setup_theme', 'alium_child_theme_setup');

// show excerpt in yoast seo description if meta description is empty or create meta from page content
add_filter('wpseo_metadesc', 'alium_wpseo_metadesc');
function alium_wpseo_metadesc($metadesc)
{
    if (is_singular() && empty($metadesc)) {
        $metadesc = strip_tags(get_the_excerpt());

        if (empty($metadesc)) {
            // create meta from page content only 120 symbols
            $metadesc = strip_tags(get_the_content());
            $metadesc = mb_substr($metadesc, 0, 120);
            if (mb_strlen(strip_tags(get_the_content())) > 120) {
                $metadesc .= '...';
            }
        }
    } elseif (is_front_page()) {
        $metadesc = apply_filters('the_excerpt', $metadesc);
    }
    return $metadesc;
}

//yoast seo title for home page
add_filter('wpseo_title', 'alium_wpseo_title');
function alium_wpseo_title($title)
{
    if (is_front_page()) {
        $title = apply_filters('the_title', $title);
    }
    return $title;
}

// customize post thumbnail alt attribute
add_filter('wp_get_attachment_image_attributes', 'alium_wp_get_attachment_image_attributes', 99, 3);
function alium_wp_get_attachment_image_attributes($attr, $attachment, $size)
{
    if (is_singular()) {
        $attr['alt'] = apply_filters('the_title', $attr['alt']);
    }
    return $attr;
}




