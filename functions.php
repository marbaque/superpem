<?php

/**
 * Super PEM functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Super_PEM
 */
if (!function_exists('superpem_setup')) :

    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function superpem_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Super PEM, use a find and replace
         * to change 'superpem' to the name of your theme in all the template files.
         */
        load_theme_textdomain('superpem', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('superpem-full-bleed', 2000, 500, true);
        add_image_size('superpem-index-img', 780, 240, true);


        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Main menu', 'superpem'),
            'creditos-menu' => esc_html__('Menu for credits or similar', 'superpem'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('superpem_custom_background_args', array(
            'default-color' => 'f2f2f2',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        //add theme support for Custom logo
        add_theme_support('custom-logo', array(
            'width' => 100,
            'height' => 100,
            'flex-width' => true,
        ));


        // Add theme support for Custom Header
        register_default_headers(array(
            'default-image' => array(
                'url' => get_template_directory_uri() . '/img/header.jpg',
                'thumbnail_url' => get_template_directory_uri() . '/img/header.jpg',
                'description' => __('Default Header Image', 'textdomain')
            ),
        ));

        $header_args = array(
            'default-image' => get_template_directory_uri() . '/img/header.jpg',
            'width' => 1200,
            'height' => 960,
            'flex-width' => true,
            'flex-height' => true,
            'uploads' => true,
            'random-default' => false,
            'header-text' => true,
            'default-text-color' => '',
            'wp-head-callback' => '',
            'admin-head-callback' => '',
            'admin-preview-callback' => '',
            'video' => true,
            'video-active-callback' => '',
        );
        add_theme_support('custom-header', $header_args);

        /* Editor styles */
        add_editor_style(array('inc/editor-styles.css'));
    }

endif;
add_action('after_setup_theme', 'superpem_setup');

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function superpem_resource_hints($urls, $relation_type) {
    if (wp_style_is('superpem-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'superpem_resource_hints', 10, 2);

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function superpem_content_width() {
    $GLOBALS['content_width'] = apply_filters('superpem_content_width', 960);
}

add_action('after_setup_theme', 'superpem_content_width', 0);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function superpem_content_image_sizes_attr($sizes, $size) {
    $width = $size[0];

    if (900 <= $width) {
        $sizes = '(min-width: 900px) 700px, 900px';
    }

    if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2') || is_active_sidebar('sidebar-3')) {
        $sizes = '(min-width: 900px) 600px, 900px';
    }

    return $sizes;
}

add_filter('wp_calculate_image_sizes', 'superpem_content_image_sizes_attr', 10, 2);

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function superpem_header_image_tag($html, $header, $attr) {
    if (isset($attr['sizes'])) {
        $html = str_replace($attr['sizes'], '100vw', $html);
    }
    return $html;
}

add_filter('get_header_image_tag', 'superpem_header_image_tag', 10, 3);

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @origin Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */
function superpem_post_thumbnail_sizes_attr($attr, $attachment, $size) {

    if (!is_singular()) {
        if (is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-2') || is_active_sidebar('sidebar-3')) {
            $attr['sizes'] = '(max-width: 900px) 90vw, 800px';
        } else {
            $attr['sizes'] = '(max-width: 1200px) 90vw, 1000px';
        }
    } else {
        $attr['sizes'] = '100vw';
    }

    return $attr;
}

add_filter('wp_get_attachment_image_attributes', 'superpem_post_thumbnail_sizes_attr', 10, 3);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function superpem_widgets_init() {
    register_sidebar(array(
        'name' => esc_html__('Sidebar-Blog', 'superpem'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add footer widgets here.', 'superpem'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar-Paginas', 'superpem'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add footer widgets here.', 'superpem'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar-Multimedia', 'superpem'),
        'id' => 'sidebar-3',
        'description' => esc_html__('Add footer widgets here.', 'superpem'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar-Footer', 'superpem'),
        'id' => 'footer-1',
        'description' => esc_html__('Add footer widgets here.', 'superpem'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'superpem_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function superpem_scripts() {

    //enquue fuentes de google: Lora
    wp_enqueue_style('superpem-fonts', 'https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i');
    
    wp_enqueue_style('superpem-style', get_stylesheet_uri());
    
    //wp_enqueue_script('superpem-fontawesome', 'https://use.fontawesome.com/f9e8212f45.js');

    wp_enqueue_script('superpem-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '20151215', true);
    wp_localize_script('superpem-navigation', 'superpemScreenReaderText', array(
        'expand' => __('Expand child menu', 'superpem'),
        'collapse' => __('Collapse child menu', 'superpem'),
    ));

    wp_enqueue_script('superpem-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20170512', true);
    wp_enqueue_script('superpem-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'superpem_scripts');


/*
 * Agregar una barra de buscar en el menu principal
 */
add_filter('wp_nav_menu_items', 'search_box_function', 10, 2);

function search_box_function($nav, $args) {
    if ($args->theme_location == 'primary') {
        return $nav .= '<li class="menu-search">' . get_search_form(false) . '</li>';
    }

    return $nav;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load bredacrumbs.
 */
require get_template_directory() . '/inc/breadcrumbs.php';


