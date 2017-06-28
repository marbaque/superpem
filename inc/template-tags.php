<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Super_PEM
 */
if (!function_exists('superpem_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function superpem_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date('c')), esc_html(get_the_date()), esc_attr(get_the_modified_date('c')), esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
                esc_html_x('%s', 'post date', 'superpem'), $time_string);

        $byline = sprintf(
                esc_html_x('Written by %s', 'post author', 'superpem'), '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<div class="autor"><span class="byline"> ' . $byline . '</span></div>' . ' <span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

        if (!post_password_required() && ( comments_open() || get_comments_number() )) {
            echo ' <span class="comments-link"><span class="extra">Discussion </span>';
            /* translators: %s: post title */
            comments_popup_link(sprintf(wp_kses(__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'superpem'), array('span' => array('class' => array()))), get_the_title()));
            echo '</span>';
        }

        edit_post_link(
                sprintf(
                        /* translators: %s: Name of current post */
                        esc_html__('Edit %s', 'superpem'), the_title('<span class="screen-reader-text">"', '"</span>', false)
                ), ' <span class="edit-link"><span class="extra">Admin </span>', '</span>'
        );
    }

endif;

if (!function_exists('superpem_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function superpem_entry_footer() {
        // Hide tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'superpem'));
            if ($tags_list) {
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'superpem') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link(sprintf(wp_kses(__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'superpem'), array('span' => array('class' => array()))), get_the_title()));
            echo '</span>';
        }
    }

endif;

function superpem_the_category_list() {
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list(esc_html__(', ', 'superpem'));
    if ($categories_list && superpem_categorized_blog()) {
        printf('<span class="cat-links">' . esc_html__('%1$s', 'superpem') . '</span>', $categories_list); // WPCS: XSS OK.
    }
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function superpem_categorized_blog() {
    if (false === ( $all_the_cool_cats = get_transient('superpem_categories') )) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories(array(
            'fields' => 'ids',
            'hide_empty' => 1,
            // We only need to know if there is more than one category.
            'number' => 2,
        ));

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count($all_the_cool_cats);

        set_transient('superpem_categories', $all_the_cool_cats);
    }

    if ($all_the_cool_cats > 1) {
        // This blog has more than 1 category so superpem_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so superpem_categorized_blog should return false.
        return false;
    }
}

/**
 * Flush out the transients used in superpem_categorized_blog.
 */
function superpem_category_transient_flusher() {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient('superpem_categories');
}

add_action('edit_category', 'superpem_category_transient_flusher');
add_action('save_post', 'superpem_category_transient_flusher');

/**
 * Post navigation (previous / next post) for single posts.
 */
function superpem_post_navigation() {
    the_post_navigation(array(
        'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next', 'superpem') . '</span> ' .
        '<span class="screen-reader-text">' . __('Next post:', 'superpem') . '</span> ' .
        '<span class="post-title">%title</span>',
        'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'superpem') . '</span> ' .
        '<span class="screen-reader-text">' . __('Previous post:', 'superpem') . '</span> ' .
        '<span class="post-title">%title</span>',
    ));
}

/*
 * Navegation for página de contenido multimedia
 */

function getPrevNext() {
    $args = array(// including all of the defaults here so you can play with them
        'sort_order' => 'ASC',
        'sort_column' => 'menu_order',
        'hierarchical' => 1,
        'exclude' => '',
        'include' => '',
        'meta_key' => '',
        'meta_value' => '',
        'authors' => '',
        'child_of' => 0,
        'parent' => -1,
        'exclude_tree' => '',
        'number' => '',
        'offset' => 1,
        'post_type' => 'multimedia',
        'post_status' => 'publish'
    );
    $pagelist = get_pages($args);
    $pages = array();

    foreach ($pagelist as $page) {
        $pages[] += $page->ID;
    }

    $current = array_search(get_the_ID(), $pages);
    $prevID = (isset($pages[$current - 1])) ? $pages[$current - 1] : '';
    $nextID = (isset($pages[$current + 1])) ? $pages[$current + 1] : '';

    echo '<nav class="navigation post-navigation"><div class"nav-links">';

    if (is_post_type_hierarchical(get_post_type())) {
        if (!empty($prevID) && $prevID > 0) {
            echo '<div class="nav-previous">';
            echo '<a href="';
            echo get_permalink($prevID);
            echo '"';
            echo 'title="';
            echo get_the_title($prevID);
            echo'"><span class="meta-nav" aria-hidden="true">' . __('Previous', 'superpem')
            . '</span> <span class="screen-reader-text">' . __('Previous content:', 'superpem') . '</span>'
            . '<span class="post-title">' . get_the_title($prevID) . '</span></a>';
            echo "</div>";
        }
        if (!empty($nextID)) {
            echo '<div class="nav-next">';
            echo '<a href="';
            echo get_permalink($nextID);
            echo '"';
            echo 'title="';
            echo get_the_title($nextID);
            echo'"><span class="meta-nav" aria-hidden="true">' . __('Next', 'superpem') . '</span>'
            . '<span class="screen-reader-text">' . __('Next content:', 'superpem') . '</span>'
            . '<span class="post-title">' . get_the_title($nextID) . '</span></a>';
            echo "</div>";
        }
    }
    echo '</nav></div>';
}

/*
 * Cambiar una elipse al final del resumen
 */

function superpem_resumen_mas($more) {
    return "…";
}

add_filter('excerpt_more', 'superpem_resumen_mas');



/*
 * Cambiar el largo del resumen
 */

function superpem_resumen_long($length) {
    return 60;
}

add_filter('excerpt_length', 'superpem_resumen_long');
