<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Super_PEM
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function superpem_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    // Adds a class of hfeed to non-singular pages.
    if (!is_singular()) {
        $classes[] = 'hfeed';
        $classes[] = 'archive-view';
    }

    // Adds a class telling us if the sidebar is in use.
    if (!is_singular( 'multimedia' ) && is_active_sidebar('sidebar-1')) {
        $classes[] = 'has-sidebar';
    } else {
        $classes[] = 'no-sidebar';
    }

    // Adds a class telling us if the page sidebar is in use.
    if (is_active_sidebar('sidebar-2') ) {
        $classes[] = 'has-page-sidebar';
    }
    
    if (is_singular( 'multimedia' ) && is_active_sidebar('sidebar-3') ) {
        $classes[] = 'has-page-sidebar';
        $classes[] = 'multimedia-widgets';
    }
    
    // Adds a class telling us if the page is contenido multimedia.
    if (is_singular( 'multimedia' )) {
        $classes[] = 'multimedia-page';
    }

    return $classes;
}

add_filter('body_class', 'superpem_body_classes');

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function superpem_pingback_header() {
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'superpem_pingback_header');
